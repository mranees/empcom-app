<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20|string',
            'address' => 'required|min:3|max:50',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $file_name = 'company' . time() . '.' . $request->image->extension();
        $request->image->storeAs('uploads/company', $file_name, 'public');
        $company = new Company;
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->image = $file_name;
        $company->save();

        return redirect('company');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('company.show', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::find($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->image == '' || $request->image == null)
        {
            $file_name = $company->image;
        }else{

            $file_name = 'company' . time() . '.' . $request->image->extension();
            $request->image->storeAs('uploads/company', $file_name, 'public');
        }
        
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->image = $file_name;
        $company->save();

        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect('company');
    }
}
