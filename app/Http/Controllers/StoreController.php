<?php

namespace App\Http\Controllers;

use App\Models\store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $input=store::all();
        return view('stores.create_store',compact('input'));
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
        $input=store::all();

        $validatedData=$request->validate([
                'store_name'=>'required|unique:stores|max:100',
                'country'=>'required|max:100',
                'city'=>'required|max:100',
                'governorate'=>'required|max:100',

            ]
        ) ;

        store::create([
            'store_name' =>$request->store_name,
            'country'=>$request->country,
            'city'=>$request->city,
            'governorate'=>$request->governorate,

        ]);

        session()->flash('Add','Added successfully ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
                'store_name'=>'required|unique:stores|max:100',
                'country'=>'required|max:100',
                'city'=>'required|max:100',
                'governorate'=>'required|max:100',

            ]
        ) ;

        $store=store::findorfail($id);
        $store->update(
            [
                'store_name' =>$request->store_name,
                'country'=>$request->country,
                'city'=>$request->city,
                'governorate'=>$request->governorate,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

        public function destroy(Request $request,$id)
    {
        store::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect()->back();
    }

}
