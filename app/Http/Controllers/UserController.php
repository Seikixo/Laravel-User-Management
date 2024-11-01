<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('list', ['users' => $users]);
    }

    public function create()
    {
        $user = new User();
        return view('form', [
            'user' => $user,
            'action' => 'Create', 
            'actionUrl' => 'store']
        );
    }

    public function store(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
        ]);

        User::create($validationData);

        return redirect('/')->with('success', 'User Created successfully');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('form', ['user' => $user, 'actions' => 'Update', 'actionsURL' => '/update' . $id]);
    }


    public function update(Request $request, string $id)
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validationData['name'];
        $user->age = $validationData['age'];
        $user->save();

        return view('/')->with('success', 'User Updated successfully');
    }

    public function destroy(string $id)
    {
       $user = User::findOrFail($id);
       $user->delete();

       return redirect('/')->with('success', 'User Deleted successfully');
    }
}
