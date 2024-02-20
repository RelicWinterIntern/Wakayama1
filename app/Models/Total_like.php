<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total_like extends Model
{
     public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
