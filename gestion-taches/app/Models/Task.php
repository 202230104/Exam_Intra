<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'priority', 'due_date', 'status', 'user_id'];
    protected $dates = ['due_date'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}




