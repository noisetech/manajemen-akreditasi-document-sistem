<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('pages.permission.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex justify-content-start">
                 <a href="#" class="badge bg-warning text-white mx-1" id="edit" data-id="' . $data->id . '" title="Edit">
                        Edit Hak Izin
                        </a>
                        <a class="badge bg-danger text-white" href="javascript:void(0)" data-id="' . $data->id . '" title="Hapus">
                         Hapus Hak Izin</a>
                      </a>
           </div>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }
    }


    public function tambah()
    {
        return view('pages.permission.tambah');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ], [
            'permission.required' => 'Inputan wajib di isi'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $permission = new Permission();
        $permission->name = $request->permission;
        $permission->guard_name = 'web';
        $permission->save();

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan',
            ], 200);
        }
    }


    public function getDataById($id)
    {
        $permission = Permission::findOrFail($id);

        return response()->json($permission);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission = Permission::findOrFail($request->id);
        $permission->name = $request->permission;
        $permission->guard_name = 'web';
        $permission->save();

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
            ], 200);
        }
    }

    public function hapus(Request $request)
    {
        $permission = Permission::findOrFail($request->id);

        if ($permission->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
            ], 200);
        }
    }
}
