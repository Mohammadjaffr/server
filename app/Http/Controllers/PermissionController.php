<?php

namespace App\Http\Controllers;

use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
  public function index()
  {   $Permission=Permission::all();
      return view('role-permission.permission.index',compact('Permission'));
  }
    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
      $request->validate([
         'name'=>[
             'required',
             'string',
             'unique:permissions,name'
         ]
      ]);
      Permission::create([
          'name'=>$request->name
      ]);
        session()->flash('Add','Permission Created successfully ');
        return redirect('permissions');
    }

    public function edit()
    {

    }
    public function update(Request $request,$permissionid)
    {
        $validatedData=$request->validate([
                'name'=>'required|unique:permissions|max:100',
            ]
        ) ;

        $permission=Permission::findorfail($permissionid);
        $permission->update(
            [
                'name' =>$request->name,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('permissions');
    }
    public function destroy($permissionid)
    {
        Permission::findorfail($permissionid)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('permissions');
    }
}
