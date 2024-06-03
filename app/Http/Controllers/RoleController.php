<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {   $Role=Role::all();
        return view('roles.index',compact('Role'));
    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        Role::create([
            'name'=>$request->name
        ]);
        session()->flash('Add','Role Created successfully ');
        return redirect('roles');
    }

    public function edit(Role $role)
    {

    }
    public function update(Request $request,$roleid)
    {
        $validatedData=$request->validate([
                'name'=>'required|unique:roles|max:100',
            ]
        ) ;

        $role=Role::findorfail($roleid);
        $role->update(
            [
                'name' =>$request->name,
            ]
        );
        session()->flash('edit','edited successfully ');
        return redirect('roles');
    }
    public function destroy($roleid)
    {
        Role::findorfail($roleid)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect('roles');
    }
    public  function  addPermissionToRole($roleId){
        $permissions=Permission::get();
        $role =  Role::findOrFail($roleId);
        $rolepermissions=DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id',$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('roles.add-permissions',compact('role','permissions','rolepermissions'));
    }
//    public  function givePermissionToRole(Request $request,$roleid){
//        $request->validate([
//            'permission'=>'required'
//        ]);
//        $role =  Role::findOrFail($roleid);
//        $role->syncPermissions($request->permission);
//        session()->flash('delete','Permission Adce to Role successfully ');
//        return redirect()->route('roles.index');
//
//    }
//    public function updatePermissions(Request $request, $id)
//    {
//        $role = Role::findOrFail($id);
//        $permissions = $request->input('permissions', []);
//
//        // Get permissions by IDs
//        $permissions = Permission::whereIn('id', $permissions)->get();
//
//        $role->syncPermissions($permissions);
//        session()->flash('edit','edited successfully ');
//        return redirect('roles');
////        return redirect('roles')->back()->with('success', 'تم تحديث صلاحيات الدور بنجاح.');
//    }
    public function updatePermissions(Request $request,$roleId){
        $request->validate([
            'permission' =>'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        session()->flash('edit','edited successfully ');
        return redirect('roles');
        return redirect('roles')->back()->with('success', 'تم تحديث صلاحيات الدور بنجاح.');


    }
}
