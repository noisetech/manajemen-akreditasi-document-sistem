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

        $this->validate($request,[
            'judul' => 'required',
            'penulis' => 'required',
            'tanggal_penelitian' => 'required',
            'keterangan' => 'required'
        ]);

        $penelitian = new Penelitian();
        $penelitian->judul = $request->judul;
        $penelitian->penulis = $request->penulis;
        $penelitian->tanggal_penelitian = $request->tanggal_penelitian;
        $penelitian->keterangan = $request->keterangan;
        $penelitian->save();

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
