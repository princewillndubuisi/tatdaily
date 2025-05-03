<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'image',
        'video',
        'name',
        'user_id',
        'post_status',
        'usertype',
        'category_id',
    ];

    // public function images() {
    //     return $this->hasMany(images::class); // Adjust according to your actual model name
    // }

    public function likes() {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // public function scopeWithCategory($query, $categories) {
    //     $query->whereHas('category', function($query) use ($categories) {
    //         $query->where('category_id', $this->categories);
    //     });
    // }
}
