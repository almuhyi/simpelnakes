<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingBanner;
use Illuminate\Http\Request;

class AdvertisingBannersController extends Controller
{
    public function index()
    {
        $this->authorize('admin_advertising_banners');


        $banners = AdvertisingBanner::paginate(15);

        $data = [
            'pageTitle' => 'Daftar banner',
            'banners' => $banners
        ];

        return view('admin.advertising.banner.lists', $data);
    }

    public function create()
    {
        $this->authorize('admin_advertising_banners_create');

        $data = [
            'pageTitle' => 'Banner baru'
        ];

        return view('admin.advertising.banner.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_advertising_banners_create');

        $this->validate($request, [
            'title' => 'required',
            'position' => 'required',
            'image' => 'required',
            'size' => 'required',
            'link' => 'required',
        ]);

        $data = $request->all();

        $banner = AdvertisingBanner::create([
            'position' => $data['position'],
            'size' => $data['size'],
            'link' => $data['link'],
            'published' => $data['published'],
            'title' => $data['title'],
            'image' => $data['image'],
            'created_at' => time(),
        ]);

        return redirect('/admin/advertising/banners');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_advertising_banners_edit');


        $banner = AdvertisingBanner::findOrFail($id);

        $data = [
            'pageTitle' => 'Edit',
            'banner' => $banner
        ];

        return view('admin.advertising.banner.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_advertising_banners_edit');

        $this->validate($request, [
            'title' => 'required',
            'position' => 'required',
            'image' => 'required',
            'size' => 'required',
            'link' => 'required',
        ]);

        $data = $request->all();

        $banner = AdvertisingBanner::findOrFail($id);

        $banner->update([
            'position' => $data['position'],
            'size' => $data['size'],
            'link' => $data['link'],
            'published' => $data['published'],
            'title' => $data['title'],
            'image' => $data['image'],
        ]);


        return redirect('/admin/advertising/banners');
    }

    public function delete($id)
    {
        $this->authorize('admin_advertising_banners_delete');

        $banner = AdvertisingBanner::findOrFail($id);

        $banner->delete();

        return redirect('/admin/advertising/banners');
    }
}
