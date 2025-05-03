<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName() {
        return 'slug';
    }

    // Click
    public function clicks() {
        return $this->hasMany(Click::class);
    }

    // User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Tag
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
