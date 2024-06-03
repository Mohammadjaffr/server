<?php

namespace App\Http\Controllers;

use App\Models\packing;
use Illuminate\Http\Request;

class PackingController extends Controller
{
    public function index()
    {
        $packings=packing::all();
        return view('packing.packing',compact('packings'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {

        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input


        $validatedData=$request->validate([
                'pk_code'=>'required|unique:packings|max:100',
                'pk_des'=>'max:100',
            ]
        ) ;

        packing::create([
            'pk_code' =>$request->pk_code,
            'pk_des'=>$request->pk_des,

        ]);

        session()->flash('Add','Added successfully ');
        return redirect('pk');
    }
    public function show(packing $packing)
    {
        //
    }
    public function edit(packing $packing)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $validatedData=$request->validate([
                'pk_code'=>'required|unique:packings|max:100',
                'pk_des'=>'max:100',
            ]
        ) ;

        $packing=packing::findorfail($id);
        $packing->update(
            [
                'pk_code' =>$request->pk_code,
                'pk_des'=>$request->pk_des,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('pk');
    }

    public function destroy(packing $packing,$id)
    {
        packing::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('pk');
    }
}
