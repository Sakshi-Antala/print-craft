<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table='user';
    public $timestamps=false;
    protected $primaryKey='uid';
    protected $fillable=['name','mobile','email','password','dob','address','pincode','terms','status'];
    protected $attributes=[
        'terms'=>0,
        'u_status'=>0
    ];

}
