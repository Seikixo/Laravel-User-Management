<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('form', [
            'user' => $user,
            'action' => 'Create', 
            'actionUrl' => 'store']
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
        ]);

        User::create($validationData);

        return redirect('/')->with('success', 'User Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('form', ['user' => $user, 'actions' => 'Update', 'actionsURL' => '/update' . $id]);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $user = User::findOrFail($id);
       $user->delete();

       return redirect('/')->with('success', 'User Deleted successfully');
    }
}
