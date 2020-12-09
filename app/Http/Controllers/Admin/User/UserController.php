<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Middleware\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('Role:Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where('role_id','!=',1)
            ->with('role')
            ->get();
        //return $users;
        $data = [];
        $users_data = [];
        foreach ($users as $user){
            $data['user_id'] = $user->id;
            $data['user_name'] = $user->user_name;
            $data['first_name'] = $user->first_name;
            $data['last_name'] = $user->last_name;
            $data['role'] = $user->role['name'];
            array_push($users_data,$data);
        }
       // return $users_data;
        return view('Admin.UsersManagement.Index',compact('users_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
       $user = User::where('id',$user_id)
              ->with('role')
              ->with('country')
              ->first();

        // return $user;
       $user_data = [];
     // return $user->country['name'];
         $user_data['user_id'] = $user->id;
         $user_data['user_name'] = $user->user_name;
         $user_data['first_name'] = $user->first_name;
         $user_data['last_name'] = $user->last_name;
         $user_data['email'] = $user->email;
         $user_data['country'] = $user->country['name'];
         $user_data['gender'] = $user->gender;
         $user_data['phone_number'] = $user->phone_number;
         $user_data['role'] = $user->role['name'];
         $user_data['created_at'] = $user->created_at;
         $user_data['credit'] = $user->credit;


       // return $user_data;
       return view('Admin.UsersManagement.Show',compact('user_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::where('id',$user_id)
            ->with('role')
            ->first();

        $role = \App\Models\User\Role::where('id',$user->role_id)->first();
        $userRole = $role->name;
        $roles = \App\Models\User\Role::where('name','!=','Admin')
            ->where('name','!=',$userRole)
            ->pluck('name','id');
       return view('Admin.UsersManagement.ManageUserRole',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::where('id',$user_id)->first();
        $userRole = \App\Models\User\Role::where('id',$request->role)->first();
      // return $userRole;
        if ($userRole->name != 'User') {
            $old_user = User::where('role_id', $request->role)->first();
            if (!$old_user){
                $user->role_id = $request->role;
                $user->save();
            }else{
                $old_user->role_id = 8;
                $old_user->save();
                $user->role_id = $request->role;
                $user->save();
            }


        }else{
            $user->role_id = $request->role;
            $user->save();
        }

        return redirect()->route('Users.index')->with('success','تم تعديل صلاحية المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
