<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Image;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Menu::select('id', 'nama_menu', 'kategori', 'foto', 'harga', 'keterangan')
            ->when($search, function ($q, $search) {
                return $q->where('nama_menu', 'like', "%{$search}%");
            })
            ->orderBy('kategori')
            ->paginate(50);
        $data->map(function ($row) {
            $row->foto = asset("images/{$row->foto}");
            return $row;
        });
        return view('menu.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|min:4',
            'harga' => 'required|numeric',
            'file_foto' => 'required|image|max:2000',
            'kategori' => 'required|in:makanan,minuman'
        ]);

        $folder = 'images';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $file = $request->file('file_foto');
        $ext = $file->getClientOriginalExtension();
        $filename = date('Ymdhis') . '.' . $ext;
        $img = Image::make($file);
        $img->fit(300, 200);
        $img->save($folder . '/' . $filename);
        $request->merge([
            'foto' => $filename,
        ]);
        Menu::create($request->all());
        return to_route('menu.index')->with('status', 'save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menu->foto = asset("images/{$menu->foto}");
        return view('menu.edit', [
            'row' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|min:4',
            'harga' => 'required|numeric',
            'file_foto' => 'nullable|image|max:2000',
            'kategori' => 'required|in:makanan,minuman'
        ]);
        if ($request->file_foto) {

            $folder = 'images';
            $foto_lama = "{$folder}/{$menu->foto}";
            if (file_exists($foto_lama)) {
                unlink($foto_lama);
            }
            $file = $request->file('file_foto');
            $ext = $file->getClientOriginalExtension();
            $filename = date('Ymdhis') . '.' . $ext;
            $img = Image::make($file);
            $img->fit(300, 200);
            $img->save($folder . '/' . $filename);
            $request->merge([
                'foto' => $filename,
            ]);
        }
        $menu->update($request->all());
        return to_route('menu.index')->with('status', 'edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $folder = 'images';
        $foto_lama = "{$folder}/{$menu->foto}";
        if (file_exists($foto_lama)) {
            unlink($foto_lama);
        }
        $menu->delete();
        return back()->with('status', 'delete');
    }
}