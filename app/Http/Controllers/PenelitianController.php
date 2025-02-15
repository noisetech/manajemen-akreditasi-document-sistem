<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function index()
    {
        $penelitian = Penelitian::paginate(5);

        return view('pages.penelitian.index', [
            'penelitian' => $penelitian
        ]);
    }

    public function tambah()
    {
        return view('pages.penelitian.tambah');
    }

    public function simpan(Request $request)
    {

        $this->validate($request, [
            'judul' => 'required',
            'penulis' => 'required',
            'tanggal_penelitian' => 'required',
            'keterangan' => 'required',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'judul.required' => 'judul tidak boleh kosong',
            'penulis.required' => 'penulis tidak boleh kosong',
            'tanggal_penelitian.required' => 'tanggal penelitian tidak boleh kosong'
        ]);

        $penelitian = new Penelitian();
        $penelitian->judul = $request->judul;
        $penelitian->penulis = $request->penulis;
        $penelitian->tanggal_penelitian = $request->tanggal_penelitian;
        $penelitian->keterangan = $request->keterangan;
        $penelitian->save();

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $path = $cover->storeAs('assets/cover-penelitian', $coverName, 'public');
            $penelitian->cover = $path;
            $penelitian->save();
        }


        return redirect()->route('penelitian')->with('status', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $penelitian = Penelitian::find($id);

        return view('pages.penelitian.edit', [
            'penelitian' => $penelitian
        ]);
    }

    public function update(Request $request, $id)
    {
        $penelitian = Penelitian::find($id);
        $penelitian->judul = $request->judul;
        $penelitian->penulis = $request->penulis;
        $penelitian->tanggal_penelitian = $request->tanggal_penelitian;
        $penelitian->keterangan = $request->keterangan;
        $penelitian->save();

        return redirect()->route('penelitian')->with('status', 'Data berhasil diubah');
    }


    public function hapus($id)
    {
        $penelitian = Penelitian::find($id);

        $penelitian->delete();

        return redirect()->route('penelitian')->with('status', 'Data berhasil dihapus');
    }
}
