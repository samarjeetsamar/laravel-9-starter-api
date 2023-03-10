<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'slug', 'user_id', 'status', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

}
