<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function show()
    {
        $customers = User::where('id_rol', [4, 5, 6, 7])->get();
        $warehousemen = User::where('id_rol', 2)->get();
        $delivery = User::where('id_rol', 3)->get();
        $admins = User::where('id_rol', 1)->get();
        $roles = Role::all();
        return view('roles.admin.pages.customers', compact('customers', 'roles', 'warehousemen', 'delivery', 'admins'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $validatedData = $request->validate([
                'firstname' => 'required|max:100|min:2',
                'lastname' => 'required|max:100|min:2',
                'dni' => 'required|max:10|min:7',
                'celphone' => 'required',
                'company_name' => 'nullable',
                'rol' => 'required',
                'type_customer' => 'nullable',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:5|max:255',
            ]);
            $rol = 0;
            if ($validatedData['rol'] == 1 || $validatedData['rol'] == 2 || $validatedData['rol'] == 3) {
                $rol = $validatedData['rol'];
            } else {
                $rol = $validatedData['type_customer'];
            }

            $user = new User();
            $user->firstname = $validatedData['firstname'];
            $user->lastname = $validatedData['lastname'];
            $user->celphone = $validatedData['celphone'];
            $user->company_name = $validatedData['company_name'];
            $user->dni = $validatedData['dni'];
            $user->username = $validatedData['firstname'];
            $user->id_rol = $rol;
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);

            $user->save();
            $id_user = $user->id;

            $email = new Email;
            $email->email = $validatedData['email'];
            $email->password = bcrypt($validatedData['password']);
            $email->type_email = 1;
            $email->idUser = $id_user;
            $email->save();

            $permission = new ModelHasRole;
            $permission->role_id  = $validatedData['rol'];
            $permission->model_type = 'App\Models\User';
            $permission->model_id = $id_user;
            $permission->save();

            return redirect()->back()->with('success', 'Cliente creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al crear nuevo cliente.'.$e);
        }
    }

    public function customer_profile(Request $request)
    {
        $id_user = $request->input('id');
        $user = User::find($id_user);
        $emails = Email::where('idUser', $id_user)->get();
        return view('roles.admin.pages.customers_profile', compact('user', 'emails'));
    }
    public function customer_profile_update(Request $request)
    {
        try {
            $attributes = $request->validate([
                'email' => 'nullable',
                'password' => 'nullable',
                'company_name' => ['max:100'],
                'city' => ['max:100'],
                'about' => ['max:255'],
                'firstname' => ['max:100'],
                'lastname' => ['max:100'],
                'dni' => ['max:10'],
                'celphone' => ['max:12'],
                'address' => ['max:100']
            ]);

            $id_user = $request->input('id_user');
            $profile = User::find($id_user);
            if (!empty($attributes['email'])) {
                $existingUser = User::where('email', $attributes['email'])->first();
                if ($existingUser && $existingUser->id != $id_user) {
                    return;
                }

                $profile->email = $attributes['email'];
            }
            if (!empty($attributes['password'])) {
                $profile->password = bcrypt($attributes['password']);
            }
            $profile->company_name = $attributes['company_name'];
            $profile->city = $attributes['city'];
            $profile->about = $attributes['about'];
            $profile->firstname = $attributes['firstname'];
            $profile->lastname = $attributes['lastname'];
            $profile->dni = $attributes['dni'];
            $profile->celphone = $attributes['celphone'];
            $profile->address = $attributes['address'];
            $profile->save();

            return redirect('/clientes')->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect('/clientes')->with('error', 'Hubo un problema al actualizar el perfil.');
        }
    }

    public function customer_terminate(Request $request)
    {
        try {
            $id = $request->input('id');
            $user = User::find($id);
            $user->state = 2;
            $user->save();
            return redirect('/clientes')->with('success', 'Se dió de baja a usuario con éxito.');
        } catch (\Exception $e) {
            return redirect('/clientes')->with('error', 'No se pudo dar de baja a usuario.');
        }
    }

    public function customer_profile_update_photo(Request $request)
    {
        try {
            $attributes = $request->validate([
                'idUser' => 'required',
                'photo' => 'mimes:png,jpg,jpeg',
            ]);

            $idUser = $request->input('idUser');

            $user = User::find($idUser);
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('ProfileImg', 'public');
                $user->photo = $photoPath;
            }
            $user->save();

            return redirect()->back()->with('success', 'Imagen actualizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al cambiar imagen.');
        }
    }

    public function new_subemail(Request $request)
    {
        try {
            $attributes = $request->validate([
                'idUser' => 'required',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:5|max:255',
            ]);

            $email = new Email;
            $email->email = $attributes['email'];
            $email->password = bcrypt($attributes['password']);
            $email->type_email = 2;
            $email->idUser = $attributes['idUser'];
            $email->save();


            return redirect('/clientes')->with('success', 'Sub email creado con éxito.');
        } catch (\Exception $e) {
            return redirect('/clientes')->with('error', 'Hubo un problema al crear el sub email.');
        }
    }

    public function delete_subemail(Request $request)
    {
        try {
            $emailId = $request->input('emailId');

            $email = Email::find($emailId);
            $email->detele();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
