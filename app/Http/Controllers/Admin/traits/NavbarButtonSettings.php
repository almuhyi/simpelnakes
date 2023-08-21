<?php

namespace App\Http\Controllers\Admin\traits;

use App\Models\NavbarButton;
use App\Models\Role;
use Illuminate\Http\Request;

trait NavbarButtonSettings
{
    protected $settingName = 'navbar_button';

    public function navbarButtonSettings(Request $request)
    {

        $this->authorize('admin_settings_personalization');

        $navbarButtons = NavbarButton::query()
            ->with([
                'role'
            ])->get();


        $data = [
            'pageTitle' => 'Pengaturan',
            'navbarButtons' => $navbarButtons,
            'name' => $this->settingName,
            'roles' => Role::all()
        ];

        return view('admin.settings.personalization', $data);
    }

    public function storeNavbarButtonSettings(Request $request)
    {
        $this->authorize('admin_settings_personalization');

        $itemId = $request->get('item_id');

        $this->validate($request, [
            'role_id' => 'required|unique:navbar_buttons' . (!empty($itemId) ? (',role_id,' . $itemId) : ''),
            'title' => 'required',
            'url' => 'required',
        ]);

        $data = $request->all();

        $navbarButton = NavbarButton::where('role_id', $data['role_id'])->first();

        if (empty($navbarButton)) {
            $navbarButton = NavbarButton::create([
                'role_id' => $data['role_id'],
                'title' => $data['title'],
                'url' => $data['url'],
            ]);
        }

        return redirect('/admin/settings/personalization/navbar_button');
    }

    public function navbarButtonSettingsEdit(Request $request, $id)
    {
        $this->authorize('admin_settings_personalization');

        $navbarButton = NavbarButton::findOrFail($id);

        $data = [
            'pageTitle' => 'Pengaturan',
            'navbarButton' => $navbarButton,
            'roles' => Role::all(),
            'name' => $this->settingName,
        ];

        return view('admin.settings.personalization', $data);
    }

    public function navbarButtonSettingsDelete($id)
    {
        $this->authorize('admin_settings_personalization');

        $navbarButton = NavbarButton::findOrFail($id);

        $navbarButton->delete();

        return redirect('/admin/settings/personalization/navbar_button');
    }
}
