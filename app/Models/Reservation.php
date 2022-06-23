<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// reservation 表的model类
class Reservation extends Model
{
    use HasFactory;
    // 表名
    protected $table = 'reservation';
    // 表中的字段
    protected $fillable = [
        'invitation', // 当
        'email',
        'reserve_date_at',
        'checkin',
        'checkin_at',
    ];


}
