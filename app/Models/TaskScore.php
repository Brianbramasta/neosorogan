<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskScore extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'teacher_id', 'star_count', 'comment'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
