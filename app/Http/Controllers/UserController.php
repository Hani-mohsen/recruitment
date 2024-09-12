<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// Use yajra datatables

use Yajra\Datatables\Datatables;
use App\Models\User;

class UserController extends Controller
{
    // Fetch all users
    public function index()
    {
        if(request()->ajax()){
            $users = User::all();
            // render Datatable ajax response
            // set column actions for datatable->editColumn('action', function ($user))
            $table = Datatables::of($users);
            $table->addColumn('action', function ($user) {
                $template = '
                    <a href="' . route('users.show', $user->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                    <a href="javascript:void(0)" data-rowid="' . $user->id . '" class="btn btn-outline-warning btn-sm border-0 text-black user-edit" data-bs-toggle="modal" data-bs-target="#updateModel"><i class="fa fa-edit fadeIn animated"></i></a>
                    <form action="' . route('users.destroy', $user->id) . '" method="POST" data-ajax-delete="true" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black user-delete" data-id="'. $user->id .'"><i class="fa fa-trash-alt fadeIn animated"></i></button>
                    </form>
                ';
                return $template;
            });


            $table->rawColumns(['action']);
            // set row id to tr data-priority
            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            
            return $table->make(true);
        }

        return view('users.index');
    }

    // Fetch a single user by ID
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    
   

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // add password confirm validation
            'comfirm_password' => 'required|same:password'
        ]);

        $created = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        // if created return success message
        return $created ? response()->json(['success' => 'User saved successfully.']) : response()->json(['error' => 'User not saved. try again.']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }   

    public function update(Request $request, $id)   
    {
        $request->validate([
            'name' => 'required',
            // check if email is not the same as the current email and uniqe
            'email' => 'required|email|unique:users,email,' . $id,
            
            'password' => 'nullable|min:6',
            // add password confirm validation
            'comfirm_password' => 'nullable|same:password'
        ]);
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email']);
        if(!empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }
        $updated = $user->update($data);
        if($request->ajax()){
            return $updated ? response()->json(['success' => 'User updated successfully.']) : response()->json(['error' => 'User not updated. try again.']);
        }
        
        return $updated ? redirect()->route('users.index')->with('success', 'User updated successfully.') : redirect()->route('users.index')->with('error', 'User not updated. try again.');
    }

    public function destroy($id)
    {
        $deleted = User::find($id)->delete();
        if(request()->ajax()){
            return $deleted ? response()->json(['success' => 'User deleted successfully.']) : response()->json(['error' => 'User not deleted. try again.']);
        }

        return $deleted ? redirect()->route('users.index')->with('success', 'User deleted successfully.') : redirect()->route('users.index')->with('error', 'User not deleted. try again.');
    }
}
