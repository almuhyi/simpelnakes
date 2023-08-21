<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $this->authorize('admin_unit');

        $units = Unit::withCount('user')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Unit kerja',
            'units' => $units
        ];

        return view('admin.unit.unit', $data);
    }

    public function create()
    {
        $this->authorize('admin_unit_create');

        $data = [
            'pageTitle' => 'Tambah departemen baru',
        ];

        return view('admin.unit.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_unit_create');

        $this->validate($request, [
            'nama' => 'required',
            'singkatan' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        $data = $request->all();

        Unit::create([
            'nama' => $request->nama,
            'singkatan' => $request->singkatan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);


        return redirect('/admin/unit');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_unit_edit');

        $unit = Unit::findOrFail($id);

        $data = [
            'pageTitle' => 'Edit Unit kerja',
            'unit' => $unit
        ];

        return view('admin.unit.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_support_departments_edit');

        $this->validate($request, [
            'nama' => 'required',
            'singkatan' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        Unit::where('id', $id)
        ->update([
            'nama' => $request->nama,
            'singkatan' => $request->singkatan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);

        return redirect('/admin/unit');
    }

    public function delete($id)
    {
        $this->authorize('admin_unit_delete');

        $unit = Unit::findOrFail($id);

        $unit->delete();

        return redirect('/admin/unit');
    }
}
