<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
protected $fillable = ['Course Name','Success Rate','Improvement Plan','Causes of Drawbacks','Content Effectiveness'];
}
