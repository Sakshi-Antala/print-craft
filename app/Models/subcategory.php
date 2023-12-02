<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey='sub_cat_id';
    protected $fillable=['s_c_name','cat_id'];
}
