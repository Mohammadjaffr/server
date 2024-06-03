<?php

namespace App\Http\Controllers;

use App\Models\packing;
use App\Models\unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $units=unit::with('pk')->get();
        $packings=packing::all();
        return view('units.create',compact('units','packings'));
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
                'Unit_code'=>'required|unique:units|max:100',
                'Unit_des'=>'max:100',
                'packing_id'=>'required'
            ]
        ) ;

        unit::create([
            'Unit_code' =>$request->Unit_code,
            'Unit_des'=>$request->Unit_des,
            'packing_id'=>$request->packing_id,
        ]);

        session()->flash('Add','Added successfully ');
        return redirect('unit');
    }

    /**
     * Display the specified resource.
     */
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData=$request->validate([
                'Unit_code'=>'required|unique:units|max:100',
                'Unit_des'=>'max:100',
                'packing_id'=>'required'
            ]
        ) ;

        $unit=unit::findorfail($id);
        $unit->update(
            [
                'Unit_code' =>$request->Unit_code,
                'Unit_des'=>$request->Unit_des,
                'packing_id'=>$request->packing_id,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('unit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        unit::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('unit');
    }
}
