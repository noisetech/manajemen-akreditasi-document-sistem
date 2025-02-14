<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $kategori_berita = KategoriBerita::orderBy('kategori', 'asc')->paginate(5);

        return view('pages.kategori_berita.index', [
            'kategori_berita' => $kategori_berita
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required'
        ]);

        $kategori_berita = new KategoriBerita();
        $kategori_berita->kategori = $request->kategori;
        $kategori_berita->slug = Str::slug($request->kategori);
        $kategori_berita->save();

        return  redirect()->route('kategori_berita')->with('status', 'Data Berhasil Ditambahkan');
    }

    public function tambah()
    {
        return view('pages.kategori_berita.tambah');
    }

    public function edit($id)
    {
        $kategori_berita = KategoriBerita::find($id);
        return view('pages.kategori_berita.edit', [
            'kategori_berita' => $kategori_berita
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required'
        ]);

        $kategori_berita = new KategoriBerita();
        $kategori_berita->kategori = $request->kategori;
        $kategori_berita->slug = Str::slug($request->kategori);
        $kategori_berita->save();

        return  redirect()->route('kategori_berita')->with('status', 'Data Berhasil Diubah');
    }

    public function hapus($id)
    {
        $kategori_berita = KategoriBerita::find($id);
        $kategori_berita->delete();

        return redirect()->back('status', 'Data Berhasil Dihapus');
    }
}
