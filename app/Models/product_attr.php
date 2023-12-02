<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_attr extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='p_a_id';
    protected $fillable=['size_id','color_id','url','pid'];
}
