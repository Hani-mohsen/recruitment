<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Use yajra datatables
use Yajra\Datatables\Datatables;
use App\Models\User;

class UserController extends Controller
{
    // Fetch all users
    public function indexAjax()
    {
        if(request()->ajax()){
            $users = User::all();
            // render Datatable ajax response
            return Datatables::of($users)->make(true);
        }

        return view('users.indexajax_layout');
    }
    public function index()
    {
        
    $users = User::all();
    return view('users.index_layout', compact('users'));

    }

    // Fetch a single user by ID
}
