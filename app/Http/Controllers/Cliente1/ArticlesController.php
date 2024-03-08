<?php

namespace App\Http\Controllers\Cliente1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Fulfillment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function show()
    {
        $id_user = Auth::id();
        $articles = Article::where('idUser', $id_user)->get();
        $fulfillment = Fulfillment::all();

        return view('roles.cliente1.pages.articles', compact('articles', 'fulfillment'));
    }

    public function store(Request $request)
    {
        try {
            $attributes = $request->validate([
                'description' => ['max:100'],
                'stock' => 'nullable'
            ]);

            $id_user = Auth::id();

            $article = new Article;
            $article->description = $attributes['description'];
            $article->stock = $attributes['stock'];
            $article->idUser = $id_user;

            // Verificar si el checkbox está marcado
            if ($request->has('fulfillment')) {
                $article->fulfillment_state = 1;
            } else {
                $article->fulfillment_state = 2;
            }

            $article->save();

            return redirect()->back()->with('success', 'Articulo creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al crear el nuevo artículo.');
        }
    }
    public function update(Request $request)
    {
        try {
            $attributes = $request->validate([
                'idArticle' => 'required',
                'description' => 'required'
            ]);

            $idArticle = $request->input('idArticle');
            $article = Article::find($idArticle);
            $article->description = $attributes['description'];
            $article->save();

            return redirect()->back()->with('success', 'Articulo actualizado con éxtio.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar articulo.');
        }
    }

    public function assign_fulfillment(Request $request)
    {
        try {
            $idArticle = $request->input('idArticle');
            $idFulfillment = $request->input('idFulfillment');

            $article = Article::find($idArticle);
            if ($article) {
                $article->idFulfillment = $idFulfillment;
                $article->save();
                return redirect()->back()->with('success', 'Fulfillment asignado con éxito.');
            } else {
                return redirect()->back()->with('error', 'No se encontró el artículo.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al asignar fulfillment.');
        }
    }

    public function show_general(){

        $articles = Article::join('users', 'articles.idUser','=','users.id')->get();
        $fulfillment = Fulfillment::all();

        return view('roles.almacenero.pages.article_general', compact('articles', 'fulfillment'));
    }
}
