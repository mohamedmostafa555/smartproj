<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable =['Course Name','Academic Year','Mid','P-E','V-E','Final','Total','Description','Goals'];
}
