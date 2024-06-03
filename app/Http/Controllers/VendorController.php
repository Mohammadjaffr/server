<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $input=vendor::all();
        return view('vendor.vendor',compact('input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input

        $validatedData=$request->validate([
                'vendor_name'=>'required|max:100',
                'vendor_phone'=>'required|unique:vendors|max:20',
                'vendor_email'=>'required|unique:vendors|max:50',
                'vendor_country'=>'required|max:50',
            ]
        ) ;

        vendor::create([
            'vendor_name' =>$request->vendor_name,
            'vendor_phone'=>$request->vendor_phone,
            'vendor_email' =>$request->vendor_email,
            'vendor_country'=>$request->vendor_country,
        ]);

        session()->flash('Add','Added successfully ');
        return redirect('vendor');
    }

    /**
     * Display the specified resource.
     */
    public function show(vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   $vendor=vendor::where('id',$id)->first();
        return view('vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $vendor=vendor::where('id',$id)->first();

        $vendor->update([
            'vendor_name' =>$request->vendor_name,
            'vendor_phone'=>$request->vendor_phone,
            'vendor_email' =>$request->vendor_email,
            'vendor_country'=>$request->vendor_country,
        ]);

        session()->flash('edit','Editing successfully ');
        return redirect('vendor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        vendor::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('vendor');
    }
}
