<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['o_name','address','city','pincode','mobile','email','o_date','amount','uid','d_b_id','status','transaction_id','coupon_code','d_amt'];
}
