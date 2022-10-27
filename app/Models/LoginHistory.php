<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    public static function create($userId) {
        $model = new self();
        $model->user_id = $userId;

        $model->save();
        return $model;
    }
}
