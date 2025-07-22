<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskWord extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'word', 'description', 'example'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
