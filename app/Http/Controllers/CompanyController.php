<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        $companys=company::all();
        return view('company.company',compact('companys'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {

        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input


        $validatedData=$request->validate([
                'com_name'=>'required|unique:companies|max:100',
                'address'=>'max:100',
            ]
        ) ;

        company::create([
            'com_name' =>$request->com_name,
            'address'=>$request->com_address,

        ]);

        session()->flash('Add','Added successfully ');
        return redirect('com');
    }
    public function show(company $company)
    {
        //
    }
    public function edit(company $company)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $validatedData=$request->validate([
                'com_name'=>'required|unique:companies|max:100',
                'address'=>'max:100',
            ]
        ) ;

        $company=company::findorfail($id);
        $company->update(
            [
                'com_name' =>$request->com_name,
                'address'=>$request->com_address,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('com');
    }

    public function destroy(company $company,$id)
    {
        company::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('com');
    }
}
