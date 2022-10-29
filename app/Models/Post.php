<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;
    //softDeletes;

    protected $fillable = ['community_id', 'user_id', 'title', 'post_text', 'post_image', 'slug', 'post_url', 'votes', 'approved'];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function postVotes()
    {
        return $this->hasMany(PostVotes::class);
    }

    public function savedPost()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function isSaved($postid)
    {
        $isSaved = SavedPost::where(['user_id' => auth()->id(), 'post_id' => $postid])
            ->count() == 1 ? true : false;
        return $isSaved;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
