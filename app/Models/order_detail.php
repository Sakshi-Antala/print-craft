<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['qty','price','pid','o_id','color','size','paperstock','required_datas','logo_url','user_uploaded_design'];
}
