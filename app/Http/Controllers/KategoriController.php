<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('id', 'desc')->paginate(3);
        return view('admin.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Kategori::create($validatedData);
        $kategori = Kategori::orderBy('id', 'desc')->paginate(3);
        return view('admin.pagination.paginate_ketegori', compact('kategori'));
    }

    public function pagination(Request $request)
    {
        $kategori = Kategori::orderBy('id', 'desc')->paginate(3);
        return view('admin.pagination.paginate_ketegori', compact('kategori'));
    }

    public function destroy(string $id)
    {
        Kategori::find($id)->delete();
        $kategori = Kategori::orderBy('id', 'desc')->paginate(3);
        return view('admin.pagination.paginate_ketegori', compact('kategori'));
    }
}
