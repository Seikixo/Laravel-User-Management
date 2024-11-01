<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('list', ['employees' => $employees]);
    }

    public function create()
    {
        $employee = new Employee();
        return view('form', [
            'employee' => $employee,
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

        Employee::create($validationData);

        return redirect('/')->with('success', 'User Created successfully');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('form', [
            'employee' => $employee, 
            'actions' => 'Update', 
            'actionsURL' => 'update' . $id]
        );
    }


    public function update(Request $request, string $id)
    {
        $validationData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
        ]);

        $employee = Employee::findOrFail($id);

        $employee->name = $validationData['name'];
        $employee->age = $validationData['age'];
        $employee->save();

        return view('/')->with('success', 'User Updated successfully');
    }

    public function destroy(string $id)
    {
       $employee = Employee::findOrFail($id);
       $employee->delete();

       return redirect('/')->with('success', 'User Deleted successfully');
    }
}
