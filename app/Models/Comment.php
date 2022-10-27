<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public static function create($text, $userId, $videoId) {
        $model = new self();

        $model->text = $text;
        $model->user_id = $userId;
        $model->video_id = $videoId;

        $model->save();
        return $model;
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
