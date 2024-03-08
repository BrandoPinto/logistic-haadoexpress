<?php

namespace App\Http\Controllers\Cliente1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Resupply;
use App\Models\ResupplyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResupplyController extends Controller
{
    public function show()
    {
        $id_user = Auth::id();
        $resupplies = Resupply::where('idUser', $id_user)->get();
        return view('roles.cliente1.pages.resupply', compact('resupplies'));
    }

    public function show_admin(){
        $resupplies = Resupply::all();
        return view('roles.admin.pages.resupply', compact('resupplies'));
    }

    public function resupply_form()
    {

        $id_user = Auth::id();
        $articles = Article::where('idUser', $id_user)->get();
        return view('roles.cliente1.pages.resupply_form', compact('articles'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $attributes = $request->validate([
                'date_resupply' => 'required',
                'agency' => 'required',
                'comments' => 'nullable',
                'document' => 'mimes:png,jpg,jpeg,pdf',
            ]);

            $id_user = Auth::id();
            $idArticles = $request->input('id');
            $heights = $request->input('height');
            $widths = $request->input('width');
            $depths = $request->input('depth');
            $quantityBoxes = $request->input('quantityBox');
            $quantityArticles = $request->input('quantityArticle');

            $resupply = new Resupply;
            $resupply->date = $attributes['date_resupply'];
            $resupply->agency = $attributes['agency'];
            $resupply->state = 2;
            $resupply->comments = $attributes['comments'];

            if ($request->hasFile('document')) {
                $resupply->document = $request->file('document')->store('ResupplyDocument', 'public');
            }

            $resupply->idUser = $id_user;
            $resupply->save();
            $idResupply = $resupply->idResupply;

            foreach ($idArticles as $index => $idArticle) {
                $resupplyDetail = ResupplyDetail::create([
                    'idArticle' => $idArticle,
                    'height' => isset($heights[$index]) ? json_decode($heights[$index]) : null,
                    'width' => isset($widths[$index]) ? json_decode($widths[$index]) : null,
                    'depth' => isset($depths[$index]) ? json_decode($depths[$index]) : null,
                    'quantity_box' => isset($quantityBoxes[$index]) ? json_decode($quantityBoxes[$index]) : null,
                    'quantity_article' => isset($quantityArticles[$index]) ? json_decode($quantityArticles[$index]) : null,
                    'idResupply' => $idResupply,
                ]);
            }

            return redirect()->back()->with('success', 'Reabastecimiento enviado con éxito, cuando sea recibido se le informará.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al enviar reabastecimiento. Detalles: ' . $e->getMessage());
        }
    }

    public function resupply_detail(Request $request)
    {
        $idResupply = $request->input('id');
        $resupply = Resupply::find($idResupply);

        $detail = ResupplyDetail::join('articles', 'resupply_detail.idArticle', '=', 'articles.idArticle')
            ->where('idResupply', $idResupply)->get();

        return view('roles.cliente1.pages.resupply_detail', compact('resupply', 'detail'));
    }

    public function update_state(Request $request)
    {
        try {
            $id = $request->input('id');

            $resupply = Resupply::find($id);
            $resupply->state = 1;
            $resupply->save();

            $resupply_detail = ResupplyDetail::where('idResupply', $id)->get();
            foreach ($resupply_detail as $item) {
                $article = Article::find($item->idArticle);
                if ($article) {
                    $article->stock += $item->quantity_article;
                    $article->update();
                }
            }

            return redirect()->back()->with('success', 'Estado de reabastecimiento actualizado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado.');
        }
    }
}
