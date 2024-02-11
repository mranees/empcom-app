<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = Company::all();
        $employees = Employee::orderBy('id', 'asc')
        ->with('company')
        ->when($request->filter_company, function ($query) use ($request) {
            $query->where('company', $request->filter_company);
        })
        ->get();
        return view('employee.index', [
            'companies' => $companies,
            'employees' => $employees,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create', [
            'companies' => $companies,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20|string',
            'password' => 'required|min:8|max:12',
            'email' => 'required|min:6|max:20',
            'company' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $file_name = 'employee' . time() . '.' . $request->image->extension();
        $request->image->storeAs('uploads/employee', $file_name, 'public');
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->password = Hash::make($request->input('password'));
        $employee->email = $request->input('email');
        $employee->company = $request->input('company');
        $employee->image = $file_name;
        $employee->save();

        return redirect('employee');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('employee.show', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $companies = Company::all();
        return view('employee.edit', [
            'employee' => $employee,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        $request->validate([
            'name' => 'required',
            'password' => '',
            'email' => 'required',
            'company' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->image == '' || $request->image == null)
        {
            $file_name = $employee->image;
        }else{

            $file_name = 'employee' . time() . '.' . $request->image->extension();
            $request->image->storeAs('uploads/employee', $file_name, 'public');
        }
        $employee->name = $request->input('name');
        if($request->password == '' || $request->password == null)
        {
            $employee->password = $employee->password;
        }else{
            $employee->password = Hash::make($request->input('password'));
        }
        $employee->email = $request->input('email');
        $employee->company = $request->input('company');
        $employee->image = $file_name;
        $employee->save();

        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('employee');
    }
}
