<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paper_stock extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $primaryKey='p_s_id';
}
