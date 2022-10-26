<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityTopic extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'community_id'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function Community()
    {
        return $this->belongsToMany(Community::class);
    }
}
