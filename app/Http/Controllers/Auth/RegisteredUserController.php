<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SistConfigController;
use App\Models\Patient;
use App\Models\prePatient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $admin = User::where('level', null)->count();

        if($admin < SistConfigController::q_admin){

            
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],            
            'user' => ['required', 'integer','unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        if(Patient::where('dni', $request->user)->first()){
               
            $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'user' => $request->user,
            'password' => Hash::make($request->password),
            'level' => 2,
            'patient' => 1,        
        ]);

            $pacientes = patient::where('dni', $request->user)->first();
            $pacientes->email = $request->email;
            $pacientes->save();


        
            }else{
                $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'user' => $request->user,
                'password' => Hash::make($request->password),
                'level' => 2,
                'patient' => 0,   
            ]);
                    }

 /*      $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'user' => $request->user,
            'password' => Hash::make($request->password),

        ]);

        $userId = $user->id;

        if(Patient::where('dni', $request->user)->first()){

        } else{
            $intermediatePacient = new prePatient;

            $intermediatePacient->id_user = $userId;
            $intermediatePacient->dni = $request->user;
            
            $intermediatePacient->save();
        } */

        event(new Registered($user));

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);

        } else {
            return redirect()->route('register')->with('danger', 'Alcanzó el limite máximo de registros administrativos');
        }
    }
}
