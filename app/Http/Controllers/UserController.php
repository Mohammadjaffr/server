<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::all();
        return view('users.users',compact('data'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $role = Role::pluck('name','name')->all();
     return view('users.add',compact('role'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image=$request->file('path')->getClientOriginalName();
        $path=$request->file('path')->storeAs('user',$image,'image');

//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|same:confirm-password',
//            'roles_name' => 'required',
//            'path'=>'required',
//            'spec'=>'required',
//        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user=User::create([
            'path'=>$path,
            'name' =>$request->user_name,
            'email'=>$request->email,
            'password' =>Hash::make($request->password),
            'phone'=>$request->phone,
            'spec'=>$request->spec,
            'role_name'=>$request->role,
        ]);
//        $user = User::create($input);
        $user->syncRoles($request->role);
        session()->flash('Add','Added successfully ');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request,$id)
    {

//        $image=$request->file('path')->getClientOriginalName();
//        $path=$request->file('path')->storeAs('user',$image,'image');
/*
        $data=[
           // 'path'=>$path,
            'name' =>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'spec'=>$request->spec,
            'role_name'=>$request->role_name,
        ];

        {*/
            $this->validate($request, [
                'email' => 'email|unique:users,email,'.$id,
                'password' => 'same:confirm-password',

            ]);
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
            return redirect('user');


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function destroy(Request $request,$id)
    {
        User::findorfail($id)->delete();
        session()->flash('delete','deleted successfully ');
        return redirect()->back();
    }


}
