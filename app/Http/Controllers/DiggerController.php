<?php

namespace App\Http\Controllers;

use App\Models\digger;
use Illuminate\Http\Request;

class DiggerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $input=digger::all();
        return view('Diggers.create',compact('input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input


        $validatedData=$request->validate([
                'Rig_name'=>'required|unique:diggers|max:100',
                'Well_no'=>'required|max:100',
            ]
        ) ;

        digger::create([
            'Rig_name' =>$request->Rig_name,
            'Well_no'=>$request->Well_no,
        ]);

        session()->flash('Add','Added successfully ');
        return redirect('digger');
    }

    /**
     * Display the specified resource.
     */
    public function show(digger $digger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(digger $digger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData=$request->validate([
                'Rig_name'=>'required|unique:diggers|max:100',
                'Well_no'=>'required|max:100',
            ]
        ) ;

        $digger=digger::findorfail($id);
        $digger->update(
            [
                'Rig_name' =>$request->Rig_name,
                'Well_no'=>$request->Well_no,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('digger');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        digger::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('digger');
    }
}
