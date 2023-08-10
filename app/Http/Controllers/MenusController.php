<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;


class MenusController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::with('kategori')->latest()->paginate(5);
        return view('admin.menu', compact(['kategori', 'menu']));
    }

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

    public function update(Request $request)
    {

        if ($request->file('gambar')) {
            $validateData = $request->validate([
                'name' => 'required',
                'kategori_id' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'required'
            ]);

            $mn = Menu::find($request->up_id);
            if ($mn->gambar != null) {
                Storage::disk('public')->delete($mn->gambar);
            }
            $gambar = $request->file('gambar')->store('gambarMenu');
            $validateData['gambar'] = $gambar;

            Menu::find($request->up_id)->update($validateData);
        } else {
            $validateData = $request->validate([
                'name' => 'required',
                'kategori_id' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
            ]);

            Menu::find($request->up_id)->update($validateData);
        }

        $menu = Menu::with('kategori')->latest()->paginate(5);
        return view('admin.pagination.paginate_menu', compact('menu'))->render();
    }

    public function destroy(string $id)
    {

        $menu = Menu::find($id);
        if ($menu->gambar != null) {
            Storage::disk('public')->delete($menu->gambar);
        }

        Menu::find($id)->delete();

        $menu = Menu::with('kategori')->latest()->paginate(5);
        return view('admin.pagination.paginate_menu', compact('menu'))->render();
    }

    public function pagination(Request $request)
    {
        $menu = Menu::with('kategori')->latest()->paginate(5);
        return view('admin.pagination.paginate_menu', compact('menu'))->render();
    }
}
