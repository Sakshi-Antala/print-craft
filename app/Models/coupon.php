<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='coupon_id';
    protected $fillable=['code','type','s_date','e_date','c_status','no_of_uses','min_order','c_amount','uid'];
}
