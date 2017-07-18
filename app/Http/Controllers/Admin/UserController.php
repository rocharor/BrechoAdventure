<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\User;

class UserController extends Controller
{
    public $dataTop;
    public $modelUser;

    public function __construct(DashboardController $dashboard, User $user)
    {
        $this->dataTop = $dashboard->dashboard();
        $this->modelUser = $user;
    }

    // ROLE USER
    public function index()
    {
        $data = $this->dataTop;

        $data['users'] = $this->modelUser->all();

        return view('admin/contents/users', [
            'data' => $data
        ]);
    }
}
