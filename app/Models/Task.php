<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'student_id', 'user_id', 'due_date', 'grade', 'status'];

    // завдання належить учню
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // завдання належить викладачу
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
