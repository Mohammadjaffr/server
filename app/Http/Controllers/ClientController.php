<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\digger;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $input=client::all();
        return view('Client.client',compact('input'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Client.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input=$request->all();//يخزن كل القيم المدخلة في المتغير input

        $validatedData=$request->validate([
                'client_name'=>'required|max:100',
                'client_phone'=>'required|unique:clients|max:20',
                'client_email'=>'required|unique:clients|max:50',
                'client_country'=>'required|max:50',
            ]
        ) ;

        client::create([
            'client_name' =>$request->client_name,
            'client_phone'=>$request->client_phone,
            'client_email' =>$request->client_email,
            'client_country'=>$request->client_country,
        ]);

        session()->flash('Add','Added successfully ');
        return redirect('client');
    }

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   $client=client::where('id',$id)->first();
        return view('Client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $client=client::where('id',$id)->first();

        $client->update([
            'client_name' =>$request->client_name,
            'client_phone'=>$request->client_phone,
            'client_email' =>$request->client_email,
            'client_country'=>$request->client_country,
        ]);

        session()->flash('edit','Editing successfully ');
        return redirect('client');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        client::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('client');
    }
}
