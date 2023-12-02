<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='pid';
    protected $fillable=['pname','p_desc','required_data','min_qty','price','sub_cat_id','size_id','color_id','p_s_id','uid'];
}
