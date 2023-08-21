<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Faq;
use App\Models\Webinar;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('admin_webinars_edit');

        $this->validate($request, [
            'title' => 'required|max:255',
            'answer' => 'required',
        ]);

        $data = $request->all();

        $creator = null;

        if (!empty($data['webinar_id'])) {
            $webinar = Webinar::findOrFail($data['webinar_id']);

            $creator = $webinar->creator;
        } else if (!empty($data['bundle_id'])) {
            $bundle = Bundle::findOrFail($data['bundle_id']);

            $creator = $bundle->creator;
        }

        if (!empty($creator)) {

            $faq = Faq::create([
                'creator_id' => $creator->id,
                'webinar_id' => !empty($data['webinar_id']) ? $data['webinar_id'] : null,
                'bundle_id' => !empty($data['bundle_id']) ? $data['bundle_id'] : null,
                'created_at' => time(),
                'title' => $data['title'],
                'answer' => $data['answer'],
            ]);

        }
        return response()->json([
            'code' => 200,
        ], 200);
    }

    public function description(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $faq = Faq::where('id', $id)
            ->first();

        if (!empty($faq)) {
            return response()->json([
                'faq' => $faq
            ], 200);
        }

        return response()->json([], 422);
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $faq = Faq::find($id);

        return response()->json([], 422);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $this->validate($request, [
            'title' => 'required|max:64',
            'answer' => 'required',
        ]);

        $data = $request->all();

        $faq = Faq::find($id);

        if ($faq) {
            $faq->update([
                'updated_at' => time(),
                'title' => $data['title'],
                'answer' => $data['answer'],
            ]);
        }

        return response()->json([
            'code' => 200,
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        Faq::find($id)->delete();

        return redirect()->back();
    }
}
