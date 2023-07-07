<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileAppController extends Controller
{
    public function index()
    {
        /*if (empty(getFeaturesSettings('mobile_app_status')) or !getFeaturesSettings('mobile_app_status')) {
            return redirect('/');
        }*/


        $data = [
            'pageTitle' => 'Unduh aplikasi Seluler dan nikmatilah!',
            'pageRobot' => getPageRobotNoIndex()
        ];

        return view('web.default.mobile_app.index', $data);
    }
}
