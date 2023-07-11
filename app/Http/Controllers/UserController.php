<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function update(Request $request, User $user)
    {
        // dd($request);
        if ($request->password != $request->password2) {
            return redirect('/')->with('success', 'Confirm password not same');
        }

        // password db
        // $oldUser = User::firstWhere('id', $request->userId);
        // old password input
        // $oldPassword = bcrypt($request->oldPassword);
        // dd($oldPassword);
        // if ($oldUser->password != $oldPassword) {
        //     return 'tes';
        // }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::where('id', $request->userId)
            ->update($validatedData);

        return redirect('/')->with('success', 'Profile has been updated');

        // $redirect = new RedirectResponse('/logout');
        // $redirect->with('data', $request->input('data'));
        // $redirect->header('csrf-token', csrf_token());
        // return $redirect;
    }
}
