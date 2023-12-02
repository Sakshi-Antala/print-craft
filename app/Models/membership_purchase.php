<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membership_purchase extends Model
{
    use HasFactory;
    protected $table='membership_purchase';
    public $timestamps=false;
    protected $fillable=['mid','uid','p_date','e_date','p_amount','transaction_id','status'];
}
