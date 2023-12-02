<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agency extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['a_name','gst','uid','status'];
}
