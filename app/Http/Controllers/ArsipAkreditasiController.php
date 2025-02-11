<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class ArsipAkreditasiController extends Controller
{
    public function index() {}

    public function tambah() {}

    public function simpan(Request $request) {}

    public function update(Request $request) {}


    public function listFakultas(Request $request)
    {
        if ($request->has(q)) {
            $search = $request->q;

            $result = [];

            $fakultas = Fakultas::where('name', 'LIKE', '%' . $search . '%')->get();

            foreach ($fakultas as $f) {
                $result[] = [
                    'id' => $f->id,
                    'text' => $f->name
                ];
            }

            return response()->json($result);
        } else {

            $result = [];

            $fakultas = Fakultas::all();

            foreach ($fakultas as $f) {
                $result[] = [
                    'id' => $f->id,
                    'text' => $f->name
                ];
            }

            return response()->json($result);
        }
    }

    public function edit($id) {}

    public function hapus($id) {}
}
