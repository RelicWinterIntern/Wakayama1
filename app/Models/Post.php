<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'author_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function totalLikes()
    {
        $total = $this->belongsTo(Total_like::class, 'id', 'id');
        return $total;
        
    }

    
}



