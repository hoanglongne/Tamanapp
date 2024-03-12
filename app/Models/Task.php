<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUS_NOT_START = 'Not Start';
    const STATUS_IN_PROCESS = 'In Process';
    const STATUS_PENDING = 'Pending';
    const STATUS_DONE = 'Done';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'deadline', 
        'created_by_user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * The users that monitor the task.
     */
    public function monitoredUsers()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}