<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'Student';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'class',
        'password'
    ];
    use HasFactory;
}
