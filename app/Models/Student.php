<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
