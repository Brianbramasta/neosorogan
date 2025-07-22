<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'date', 'punishment'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function words()
    {
        return $this->hasMany(TaskWord::class);
    }
    public function scores()
    {
        return $this->hasMany(TaskScore::class);
    }
}
