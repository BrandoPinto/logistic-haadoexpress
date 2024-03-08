<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(){
        $blog = Blog::all();
        return view('roles.admin.pages.blog', compact('blog'));
    }

    public function store(Request $request){
        try {
            // Validar los datos recibidos del formulario
            $attributes = $request->validate([
                'image' => 'mimes:png,jpg,jpeg',
            ]);
    
            $blog = new Blog;
            if ($request->hasFile('image')) {
                $blog->image = $request->file('image')->store('ImageBlog', 'public');
            }
            $blog->save();

            return redirect()->back()->with('success', 'Se registro la imagen con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al registrar la imagen.'.$e->getMessage());
        }
    }
    public function update_image(Request $request)
    {
        try {
            $itemId = $request->input('itemId');
            $state = $request->input('state');
            
            // Obtener el elemento de la base de datos
            $item = Blog::find($itemId);
            
            if ($item) {
                // Cambiar el valor de state según la condición
                if ($item->state == 1) {
                    $item->state = 2;
                } else {
                    $item->state = 1;
                }
                
                $item->save();
                
                return redirect()->back()->with('success', 'Se actualizó el estado de la imagen con éxito.');
            } else {
                return redirect()->back()->with('error', 'No se encontró el elemento en la base de datos.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar la imagen.');
        }
    }
}
