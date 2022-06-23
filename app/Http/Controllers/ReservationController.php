<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// 该控制类下是实现了预定的相关方法，通过调用该类即可完成预定的相关操作
// Under this control class, the predetermined related methods are implemented, and the predetermined related operations can be completed by calling this class
class ReservationController extends Controller
{
    // 添加方法 该方法是在dashboard页面下 点击new reservation后 通过下拉列表框选择第几天 之后点击Reserve后执行的方法
    // Add method: click new reservation on the dashboard page, select the day after the day in the drop-down list box, and click reserve to execute the method
    public function add(Request $request)
    {
        // 通过调用Reservation实例化出一条新的记录，相当于创建了在表reservation中新建了一条记录，只是现在还没有值需要为它赋值
        // Creating a new record by calling the reservation instance is equivalent to creating a new record in the table reservation, but there is no value to assign to it
        $reservation = new Reservation();
        $time = time();
        // 定义一个报错信息的空数组
        // Define an empty array of error messages
        $errorMsg = array();
        // 获取页面传递过来选择的第几天
        // Get the selected day of page delivery
        $rda = $request->post('rsv_day_at');
        // 如果传递过来的值不为空后执行 对Reservation实例化对象$reservation 进行赋值
        // If the passed value is not empty, assign a value to the $reservation instantiation object
        if ($rda!=null){
            // 判断用户是否登录
            // Judge whether the user logs in
            if (Auth::check()){
                // 获取登录的用户信息
                // Get login user information
                $currentUser = Auth::user();
                // 对数据库表的数据进行筛选，查看表中是否存该用户在有这一天的预订记录
                // Filter the data in the database table to see whether the reservation record of the user on this day is saved in the table
                $checkIfHasRsvThatDay = Reservation::where('reserve_date_at',$rda)->where('email',$currentUser['email'])
                    ->count();
                // 如果查询出来的记录数为空 表示该用户当前日期可以进行预约
                // If the number of records queried is empty, the user can make an appointment on the current date
                if ($checkIfHasRsvThatDay==0) {
                    // 获取这一天的总的预约记录 查看是否大于10条
                    // Get the total appointment records of the day and check whether they are greater than 10
                    $totalRsv = Reservation::where('reserve_date_at', $rda)->count();
                    // 不大于10条可以预约 反之报错不可以预约
                    // No more than 10 items can be reserved; otherwise, no reservation can be made if an error is reported
                    if ($totalRsv < 10) {
                        // 将保存到表reservation中的记录值放到一个数组里
                        // Put the record values saved in the table reservation into an array
                        $data = [
                            'invitation' => $this->createInvitationCode(), //获取一个不在数据库中的随机6位小写字符串 Gets a random 6-bit lowercase string that is not in the database
                            'email' => $currentUser['email'], // 获取用户的email Get the user's email
                            'reserve_date_at' => $rda, // 用户选择的预约日期 Appointment date selected by the user
                            'checkin' => false, // 对是否报道赋值为否 Assign no to report
                            'checkin_at' => date('Y-m-d H:i:s', $time),  // 当前日期 current date
                        ];
                        // 调用Reservation类的create方法，向表中插入一条预约记录
                        // Call the Create method of the reservation class to insert a reservation record into the table
                        $reservation->create($data);
                        // 返回 dashboard页面
                        // Return to the dashboard page
                        return redirect('/dashboard');
                    } else {$errorMsg['fullRsv'] = 1;}
                }else{$errorMsg['aldHave']=1;}
            }else{$errorMsg['auth']=1;}
        }else{$errorMsg['rba']=1;}
        // 跳转到报错页面进行信息提示
        // Jump to the error reporting page for information prompt
        return view('error',$errorMsg);
    }

    // reservation的取消预约方法
    // Reservation cancel method
    public function cancel(Request $request)
    {
        // 判断页面传递过来的预约记录的邀请码是否为空
        // Judge whether the invitation code of the reservation record passed from the page is empty
        if($request->input('ivtcd') !== null) {
            // 将邀请码进行赋值
            // Assign an invitation code
            $invitationCode = $request->input('ivtcd');
            // 检验用户是否登录
            // check that the user is logged in
            if (Auth::check()) {
                // 获取登录的用户
                // Get logged in user
                $currentUser = Auth::user();
                // 通过邀请码获取该条数据库表中的记录值
                // Obtain the record value in the database table through the invitation code
                $data = Reservation::where('invitation',$invitationCode)->first();
                //判断该条记录中的邮箱与当前登录用户的邮箱是否相同 相同可以删除 不相同 不可以
                // Judge whether the mailbox in this record is the same as that of the currently logged in user. It can be deleted. If not, it can not be deleted
                if ($data->email == $currentUser['email']){
                    // Execute the delete method to delete this record
                    Reservation::where('invitation',$invitationCode)->delete();
                    // 返回到dashboard页面
                    // Return to dashboard page
                    return redirect('/dashboard');
                }
            }
        }
        return redirect('/dashboard');
    }
    // 定义check in 页面 输入 邀请码 和 密码 之后点击check in 之后执行的方法
    public function checkIn(Request $request)
    {
        // 如果传递过来的值不为空后执行 对Reservation实例化对象$reservation 进行赋值
        // If the passed value is not empty, assign a value to the $reservation instantiation object
        $reservation = new Reservation();
        // 定义一个报错信息的空数组
        // Define an empty array of error messages
        $errorMsg = array();
        // 获取页面传递过来的邀请码
        // Get the invitation code passed from the page
        $invitationCode = $request->post('ivtcd');
        // 获取页面传递过来的密码
        // Get the password passed from the page
        $pwd = $request->post('pwd');
        // 判断用户输入的邀请码和密码是否为空
        // Judge whether the invitation code and password entered by the user are blank
        if ($invitationCode!=null&&$pwd!=null){
            // 判断用户是否登录
            // Judge whether the user logs in
            if (Auth::check()){
                // 获取登录的用户信息
                // Get login user information
                $currentUser = Auth::user();
                // 在数据库中查询该邀请码是否存在记录
                // Query whether the invitation code has records in the database
                $checkIfHaveTheIC = Reservation::where('invitation',$invitationCode)->count();
                // 如果存在记录
                // If records exist
                if ($checkIfHaveTheIC!=0) {
                    // 检测用户输入的密码是否与登录用户的密码相同
                    // Check whether the password entered by the user is the same as that of the login user
                    if (Hash::check($pwd,$currentUser->getAuthPassword())){
                        // 如果相同，通过用户的邮箱和用户输入的邀请码在表reservation中进行查询 该预约记录是否存在
                        // If it is the same, query whether the reservation record exists in the table reservation through the user's mailbox and the invitation code entered by the user
                        $ifRightUser = Reservation::where('email', $currentUser['email'])
                            ->where('invitation',$invitationCode)->count();
                        // 如果存在
                        // If present
                        if ($ifRightUser==1){
                            // 获取该条记录的内容
                            // Get the contents of this record
                            $checkStatus = Reservation::select('checkin')->where('invitation',$invitationCode)
                                ->first();
                            // 判断这条记录是否验证过
                            // Judge whether this record has been verified
                            if ($checkStatus->checkin==0) {
                                $data = [
                                    'checkin' => true,
                                ];
                                // 如果这条记录没有验证过，对该条记录执行修改操作  将checkin的值改为1
                                // If this record has not been verified, modify it and change the value of checkin to 1
                                $reservation->where('invitation',$invitationCode)->update($data);
                                // 返回信息
                                // Return message
                                $errorMsg['succeed'] = 'Welcome, '.$currentUser['name'];
                            } else {$errorMsg['haveVerified'] = 1;}
                        }else{$errorMsg['notMatch']=1;}
                    }else{$errorMsg['wrongPwd']=1;}
                }else{$errorMsg['dontHave']=1;}
            }else{$errorMsg['auth']=1;}
        }else{$errorMsg['loseParam']=1;}
        // 执行到这表示没有验证成功 进入报错提醒页面
        // This indicates that the verification is not successful. Enter the error prompt page
        return view('error',$errorMsg);
    }

    // 该方法是创建一个不在数据库表中的六位字符串邀请码
    // This method is to create a six digit string invitation code that is not in the database table
    function createInvitationCode(): string
    {
        // 调用生成6位小写字符串的方法
        // Call the method that generates a 6-bit lowercase string
        $code = $this->createCode();
        while (true){
            $checker = Reservation::where('invitation',$code)->count();
            if ($checker==0){
                break;
            }
            $code = $this->createCode();
        }
        return $code;
    }
    // 该方法是用于创建一个随机的六位小写字母的字符串
    // This method is used to create a random string of six lowercase letters
    function createCode(): string
    {
        // 定义一个数组存放所有的小写字母
        // Define an array to hold all lowercase letters
        $codeArr = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', 'z');
        // 获取6字字符的坐标放入一个列表中
        // Get the coordinates of 6 characters and put them into a list
        $keys = array_rand( $codeArr, 6);

        $code = '';
        // 循环取出这六个字母拼接成为一个新的字符串
        // Loop out the six letters and splice them into a new string
        for ( $i = 0; $i < 6; $i++ )
        {
            $code .= $codeArr[$keys[$i]];
        }
        // 返回字符串
        // Return code
        return $code;
    }
}
