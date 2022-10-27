<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public static function create($name, $description, $status, $file, $userId) {
        $model = new self();

        $model->name = $name;
        $model->description = $description;
        $model->status = $status;
        $model->file = $file;
        $model->user_id = $userId;

        $model->save();
        return $model;
    }

    public function likes() {
        return $this->hasMany(Like::class, 'video_id', 'id');
    }

    public function dislikes() {
        return $this->hasMany(Dislike::class, 'video_id', 'id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'video_id', 'id');
    }
}
