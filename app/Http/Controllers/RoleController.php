<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        return view('pages.role.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();

            return datatables()->of($data)
                ->editColumn('permission', function ($data) {
                    $permissions = '';
                    $permissions = '<div class="d-flex flex-wrap">';
                    foreach ($data->getPermissionNames() as $permission) {
                        $permissions .= '<span class="badge bg-info mb-1 mt-1 mx-1">' . $permission . '</span>';
                    }
                    $permissions .= '</div>';
                    return $permissions;
                })
                ->addColumn('action', function ($data) {

                    if ($data->name == 'super admin' || $data->name == 'Super admin' || $data->name == 'Super Admin') {
                        $button = '<div class="d-flex justify-content-start">
                        <a href="#" class="badge bg-warning text-white" id="edit" data-id="' . $data->id . '" title="Edit">
                        Edit Level
                        </a>

                      </a>
                   </div>';

                        return $button;
                    } else {
                        $button = '<div class="d-flex justify-content-start">
                        <a href="#" class="badge bg-warning text-white mx-1" id="edit" data-id="' . $data->id . '" title="Edit">
                        Edit Level
                        </a>
                        <a class="badge bg-danger text-white hapus" href="javascript:void(0)" data-id="' . $data->id . '" title="Hapus">
                         Hapus Level</a>
                      </a>
                   </div>';

                        return $button;
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'permission'])
                ->toJson();
        }
    }


    public function listRole(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $result = [];

            $data = Permission::where('name', 'LIKE', '%' . $search . '%')->get();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json(data: $result);
        } else {
            $result = [];

            $data = Permission::all();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json($result);
        }
    }

    public function tambah()
    {
        return view('pages.role.tambah');
    }

    public function simpan(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'role' => 'required',
        //     'permission' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     response()->json($validator->errors(), 422);
        // }

        // dd($request->all());
        DB::beginTransaction();
        try {

            $role = new Role();
            $role->name = $request->role;
            $role->save();

            $permisson = Permission::whereIn('id', $request->permission)
                ->pluck('name');

            $role->syncPermissions($permisson);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Terjadi kesalahan',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getDataById($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            $role = Role::findOrFail($request->id);
            $role->name = $request->role;
            $role->save();

            $permission = Permission::whereIn('id', $request->permission)
                ->pluck('name');

            $role->syncPermissions($permission);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Terjadi kesalahan',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function hapus(Request $request)
    {
        $role = Role::findOrFail($request->id);

        if ($role->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
            ], 200);
        }
    }


    public function listPermission(Request  $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $result = [];

            $data = Permission::where('name', 'LIKE', '%' . $search . '%')->get();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json($result);
        } else {
            $result = [];

            $data = Permission::all();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json($result);
        }
    }


    public function listPermissionByRoleId($id)
    {
        $role = Role::with(['permissions'])->findOrFail($id);

        return response()->json($role);
    }
}
