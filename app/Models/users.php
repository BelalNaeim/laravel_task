<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends User
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ['name','email','password'];
}
