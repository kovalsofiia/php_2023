<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'course', 'specialty'];
    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'students_id');
    }
}
