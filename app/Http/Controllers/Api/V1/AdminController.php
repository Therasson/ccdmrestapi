<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Users:
     *      Spaces
     *          Recommendation
     *          Activity
     *      Guest
     *          History
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->with('roles')->get();
        return response([
            'users' => $users,
        ]);
    }
}
