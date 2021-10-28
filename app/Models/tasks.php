<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;
    protected $table = "tasks";
    protected $fillable = ['title','description','image','start_date','end_date','user_id'];
}
