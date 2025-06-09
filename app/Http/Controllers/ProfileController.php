<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Specialist;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function admin()
    {
        $user = User::all();
        return view('profile.register_admin', compact('user')); 
    }
    
    public function admin_store(Request $request){

        $request->validate([
            'user' => ['required', 'unique:users', 'max:255'],
            'email' => ['required', 'unique:users', 'max:255'],
        ],
        [
            'user.unique' => 'El DNI/Pasaporte ya se encuentra registrado.',
            'email.unique' => 'El Email ya se encuentra registrado.'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->user = $request->user;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->level = '3';
        $user->patient = '1';

        $user->save();

         return redirect()->route('admin.registrar')->with('success', 'Cuenta administrativa registrada');

    }


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);   
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->surname = $request->surname;
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
