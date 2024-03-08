<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        try {
            $attributes = $request->validate([
                'company_name' => ['max:100'],
                'city' => ['max:100'],
                'about' => ['max:255'],
                'firstname' => ['max:100'],
                'lastname' => ['max:100'],
                'dni' => ['max:10'],
                'celphone' => ['max:12'],
                'address' => ['max:100']
            ]);

            $id_user = Auth::id();
            $profile = User::find($id_user);
            $profile->company_name = $attributes['company_name'];
            $profile->city = $attributes['city'];
            $profile->about = $attributes['about'];
            $profile->firstname = $attributes['firstname'];
            $profile->lastname = $attributes['lastname'];
            $profile->dni = $attributes['dni'];
            $profile->celphone = $attributes['celphone'];
            $profile->address = $attributes['address'];
            $profile->save();

            return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el perfil.');
        }
    }
}
