<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culinary;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_destination = Destination::count();
        $total_user = User::count();
        $total_culinary = Culinary::count();

        return view('admin.dashboard', [
            'total_destination' => $total_destination,
            'total_culinary' => $total_culinary,
            'total_user' => $total_user
        ]);
    }
}
