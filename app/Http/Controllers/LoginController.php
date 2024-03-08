<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Busca el usuario por correo electrónico en la tabla 'emails'
        $email = Email::where('email', $request->email)->first();
    
        // Verifica las credenciales utilizando la tabla 'emails'
        if ($email && password_verify($request->password, $email->password)) {
            Auth::loginUsingId($email->idUser); // Autentica al usuario directamente
            $request->session()->regenerate();
    
            // Almacena el correo en la sesión
            session(['logged_in_email' => $request->email]);
    
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
