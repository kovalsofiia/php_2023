<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [ 'students_id','subject', 'score', 'achievement_date'];
    public function student()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
}
