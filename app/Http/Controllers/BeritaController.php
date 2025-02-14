<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['kategori_berita'])->orderBy('created_at', 'desc')->paginate(5);

        return view('pages.kategori_berita.index', [
            'berita' => $berita
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'content' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'required|file|max:2048|mimes:jpg,jpeg,png'
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->berita);
        $berita->thumbnail = $request->file('berita')->store('assets/berita', 'public');
        $berita->content = $request->content;
        $berita->save();

        return redirect()->route('berita.index')->with('status', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $berita = Berita::find($id);

        return view('pages.berita.edit', [
            'berita' => $berita
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'thumbnail' => 'nullable|file|max:2048|mimes:jpg,jpeg,png',
            'content' => 'required',
            'tanggal_post' => 'required',
            'kategori_berita' => 'required'
        ]);


        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->berita);
        $berita->content = $request->content;
        $berita->save();

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && file_exists(storage_path('app/public/' . $berita->thumbnail))) {
                Storage::delete('public/' . $berita->thumbnail);
            }

            $file = $request->file('thumbnail');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $finalName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->storeAs('assets/thumbnail-berita', $finalName, 'public');
            $berita->thumbnail = $path;
            $berita->save();
            return redirect()->route('berita.index')->with('status', 'Data berhasil diupdate');
        }

        return redirect()->route('berita.index')->with('status', 'Data berhasil diupdate');
    }

    public function hapus($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->back()->with('status', 'Data berhasil dihpaus');
    }
}
