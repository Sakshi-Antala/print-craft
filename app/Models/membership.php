<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    use HasFactory;
    protected $primaryKey='mid';
    public $timestamps=false;
    protected $fillable=['m_title','m_desc','price','duration'];
}
