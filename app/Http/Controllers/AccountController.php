<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function updatePassowrd(Request $request, $userId) {
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $validation = $validator->validate();

        User::query()->where('id', $userId)->update([
            'password' => Hash::make($validation['password'])
        ]);

        return redirect()->back()->with('message', 'Пароль обновлен');
    }
}
