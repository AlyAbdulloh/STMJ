<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::with('kategori')->latest()->paginate(5);
        return view('admin.menu', compact(['kategori', 'menu']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);
        if ($request->file('gambar')) {
            $gambar = $request->file('gambar')->store('gambarMenu');
            $validateData['gambar'] = $gambar;
        }

        Menu::create($validateData);

        $menu = Menu::latest()->paginate(5);
        return view('admin.pagination.paginate_menu', compact('menu'))->render();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // if ($request->file('gambar')) {
        //     $validateData = $request->validate([
        //         'name' => 'required',
        //         'kategori_id' => 'required',
        //         'harga' => 'required',
        //         'deskripsi' => 'required',
        //         'gambar' => 'required'
        //     ]);

        //     $mn = Menu::find($id);
        //     if ($mn->gambar != null) {
        //         Storage::disk('public')->delete($mn->gambar);
        //     }
        //     $gambar = $request->file('gambar')->store('gambarMenu');
        //     $validateData['gambar'] = $gambar;

        //     Menu::find($id)->update($validateData);
        // } else {
        //     $validateData = $request->validate([
        //         'name' => 'required',
        //         'kategori_id' => 'required',
        //         'harga' => 'required',
        //         'deskripsi' => 'required',
        //     ]);

        //     Menu::find($id)->update($validateData);
        // }

        // $menu = Menu::with('kategori')->latest()->paginate(5);
        // return view('admin.pagination.paginate_menu', compact('menu'))->render();
        return $request->up_id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
