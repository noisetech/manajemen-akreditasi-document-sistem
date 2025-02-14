<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::orderBy('name', 'asc')->paginate(5);
        return view('pages.fakultas.index', [
            'fakultas' => $fakultas
        ]);
    }



    public function tambah()
    {
        return view('pages.fakultas.tambah');
    }


    public function simpan(Request $request)
    {
        $this->validate($request, [
            'fakultas' => 'required'
        ]);

        $fakultas = new Fakultas();
        $fakultas->name = $request->fakultas;
        $fakultas->status_aktif = 'aktif';
        $fakultas->create_by = Auth::user()->name;
        $fakultas->slug = Str::slug($request->nama);
        $fakultas->save();

        return redirect()->route('fakultas')->with('status', 'Data fakultas disimpan');
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return view('pages.fakultas.edit', [
            'fakultas' => $fakultas
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fakultas' => 'required'
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->name = $request->fakultas;
        $fakultas->status_aktif = 'aktif';
        $fakultas->create_by = Auth::user()->name;
        $fakultas->slug = Str::slug($request->nama);
        $fakultas->save();

        return redirect()->route('fakultas')->with('status', 'Data fakultas diubah');
    }


    public function hapus($id){
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();

        return redirect()->route('fakultas')->with('status', 'Data fakultas dihapus');
    }

    public function changeStatusFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $newStatus = $request->query('status') == 'aktif' ? 'nonaktif' : 'aktif';

        $fakultas->update(['status_aktif' => $newStatus]);

        return redirect()->back()->with('status', 'Status berhasil diubah menjadi ' . ucfirst($newStatus));
    }
}
