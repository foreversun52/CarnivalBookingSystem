<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    public function index(Request $request)
    {
        //read configuration file.
        require_once("config/function.php");
        $GLOBALS['configInfo'] = configInfo();
        //read current user.
        $currentUser = Auth::user();
        //load current user`s reservation info
        $currentUserTotal = Reservation::where('email',$currentUser['email'])->count();

        $assign = array();
        $assign['cuName'] = $currentUser['name'];
        $assign['cuEmail'] = $currentUser['email'];
        $assign['cuTtRsv'] = $currentUserTotal;
        $assign['cuDay'] = $GLOBALS['configInfo']['CURRENT_DAY'];
        $assign['ttDays'] = $GLOBALS['configInfo']['CARNIVAL_DAYS'];
        return view('checkin',$assign);
    }
}
