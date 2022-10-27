<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'description' => '',
            'file' => 'required|mimes:mp4'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $validated = $validator->validated();

        $path = $request->file('file')->store('videos');
        $validated['file'] = $path;


        $video = Video::create(
            $validated['name'],
            $validated['description'],
            $validated['status'],
            $path,
            Auth::id()
        );

        return redirect()->route('video.one-video', ['videoId' => $video->id]);
    }

    public function update(Request $request, int $videoId) {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $validated = $validator->validated();

        $video = Video::query()->where('id', $videoId)->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Статус успешно обновлен.');
    }
}
