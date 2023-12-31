<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $this->authorize('admin_testimonials_list');


        $testimonials = Testimonial::query()->paginate(10);

        $data = [
            'pageTitle' => 'Testimoni',
            'testimonials' => $testimonials
        ];

        return view('admin.testimonials.lists', $data);
    }

    public function create()
    {
        $this->authorize('admin_testimonials_create');


        $data = [
            'pageTitle' => 'Tambah testimoni baru',
        ];

        return view('admin.testimonials.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_testimonials_create');

        $this->validate($request, [
            'user_avatar' => 'nullable|string',
            'user_name' => 'required|string',
            'user_bio' => 'required|string',
            'rate' => 'required|integer|between:0,5',
            'comment' => 'required|string',
        ]);

        $data = $request->all();

        if (empty($data['user_avatar'])) {
            $data['user_avatar'] = getPageBackgroundSettings('user_avatar');
        }

        $testimonial = Testimonial::create([
            'user_avatar' => $data['user_avatar'],
            'rate' => $data['rate'],
            'status' => $data['status'],
            'created_at' => time(),
            'user_name' => $data['user_name'],
            'user_bio' => $data['user_bio'],
            'comment' => $data['comment'],
        ]);

        return redirect('/admin/testimonials');
    }


    public function edit(Request $request, $id)
    {
        $this->authorize('admin_testimonials_edit');

        $testimonial = Testimonial::findOrFail($id);

        $data = [
            'pageTitle' => 'Edit testimoni',
            'testimonial' => $testimonial
        ];

        return view('admin.testimonials.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_testimonials_edit');

        $this->validate($request, [
            'user_avatar' => 'nullable|string',
            'user_name' => 'required|string',
            'user_bio' => 'required|string',
            'rate' => 'required|integer|between:0,5',
            'comment' => 'required|string',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $data = $request->all();

        if (empty($data['user_avatar'])) {
            $data['user_avatar'] = getPageBackgroundSettings('user_avatar');
        }


        $testimonial->update([
            'user_avatar' => $data['user_avatar'],
            'rate' => $data['rate'],
            'status' => $data['status'],
            'user_name' => $data['user_name'],
            'user_bio' => $data['user_bio'],
            'comment' => $data['comment'],
        ]);

        return redirect('/admin/testimonials');
    }

    public function delete($id)
    {
        $this->authorize('admin_testimonials_delete');

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();

        return redirect('/admin/testimonials');
    }
}
