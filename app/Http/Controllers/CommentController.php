<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function store(Request $request, int $videoId) {
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $validated = $validator->validated();


        $comment = Comment::create(
            $validated['text'],
            Auth::id(),
            $videoId
        );

        return redirect()->back();
    }
}
