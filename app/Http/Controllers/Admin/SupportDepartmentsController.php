<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportDepartment;
use Illuminate\Http\Request;

class SupportDepartmentsController extends Controller
{
    public function index()
    {
        $this->authorize('admin_support_departments');

        $departments = SupportDepartment::withCount('supports')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Departemen bantuan',
            'departments' => $departments
        ];

        return view('admin.supports.departments', $data);
    }

    public function create()
    {
        $this->authorize('admin_support_department_create');


        $data = [
            'pageTitle' => 'Tambah departemen baru',
        ];

        return view('admin.supports.department_create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_support_department_create');

        $this->validate($request, [
            'title' => 'required|string|min:2'
        ]);

        $data = $request->all();

        $department = SupportDepartment::create([
            'created_at' => time(),
            'title' => $data['title'],
        ]);


        return redirect('/admin/supports/departments');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_support_departments_edit');

        $department = SupportDepartment::findOrFail($id);


        $data = [
            'pageTitle' => 'Edit departemen',
            'department' => $department
        ];

        return view('admin.supports.department_create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_support_departments_edit');

        $this->validate($request, [
            'title' => 'required|string|min:2'
        ]);

        $data = $request->all();

        $department = SupportDepartment::findOrFail($id);

        $department->update([
            'created_at' => time(),
            'title' => $data['title'],
        ]);

        return back();
    }

    public function delete($id)
    {
        $this->authorize('admin_support_departments_delete');

        $department = SupportDepartment::findOrFail($id);

        $department->delete();

        return redirect('/admin/supports/departments');
    }
}
