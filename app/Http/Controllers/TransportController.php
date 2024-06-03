<?php

namespace App\Http\Controllers;

use App\Models\transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $input=transport::all();
        return view('transport.transport',compact('input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transport.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input

//        $validatedData=$request->validate([
//                'trans_name'=>'required|max:100',
//                'trans_phone'=>'required|unique:transports|max:20',
//                'trans_email'=>'required|unique:transports|max:50',
//                'trans_address'=>'required|max:50',
//                'plate_no'=>'required|max:50',
//            ]
//        ) ;

        transport::create([
            'trans_name' =>$request->trans_name,
            'trans_phone'=>$request->trans_phone,
            'trans_email' =>$request->trans_email,
            'trans_address'=>$request->trans_address,
            'plate_no'=>$request->plate_no,
        ]);

        session()->flash('Add','Added successfully ');
        return redirect('transport');
    }

    /**
     * Display the specified resource.
     */
    public function show(transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   $trans=transport::where('id',$id)->first();
        return view('transport.edit',compact('trans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $trans=transport::where('id',$id)->first();

        $trans->update([
            'trans_name' =>$request->trans_name,
            'trans_phone'=>$request->trans_phone,
            'trans_email' =>$request->trans_email,
            'trans_address'=>$request->trans_address,

            'plate_no'=>$request->plate_no,
        ]);

        session()->flash('edit','Editing successfully ');
        return redirect('transport');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        transport::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('transport');
    }
}
