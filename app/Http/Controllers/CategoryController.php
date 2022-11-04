<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = category::all();
        return view('kategori.index', [
            'category' => $category
        ]);
    }
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $input = $request->all();
        if ($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $folderTujuan = 'uploads/';
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path($folderTujuan), $namaFile);
            $input['gambar'] = $namaFile;
        }
        category::create($input);
        return redirect(route('category.index'));
    }

    public function delete($id)
    {
        $kategori = category::findOrFail($id);
        @unlink(public_path('uploads/' . $kategori->gambar));
        $kategori->delete();
        return redirect(route('category.index'));
    }

    public function edit($id)
    {
        $kategori = category::findOrFail($id);
        return view('kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $input = $request->all();
        $kategori = category::find($id);
        if ($request->hasFile('gambar')) {
        @unlink(public_path('uploads/' . $kategori->gambar));
        $file = $request->file('gambar');
        $folderTujuan = 'uploads/';
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path($folderTujuan), $namaFile);
        $input['gambar'] = $namaFile;
    }
    $kategori->update($input);
    return redirect(route('category.index'));
    }
}
