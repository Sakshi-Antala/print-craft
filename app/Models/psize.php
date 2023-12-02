<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class psize extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['size'];
    public $primaryKey='size_id';
}
