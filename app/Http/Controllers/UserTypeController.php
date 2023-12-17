<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserType;
use App\Models\UserTypePermission;
use Exception;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userTypes=UserType::get();
        return view('user-type.index',compact('userTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::permissionList(Permission::all());
        $data=null;
        return view('user-type.create',compact('permissions','data'));
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
        // $selectedPermissions = $request->input('permissionsList');
        // dd($selectedPermissions);
        $request->validate([
            'name' => 'required',
        ]); 

        try {
            
           
            $data = new UserType();
            $data->name = $request->name;
            $data->save();

            $permissionIds = $request->input('permissionsList');
            if ($permissionIds!=null) {
                //check permission_id exitst or not...if not exist then insert
                for ($i = 0; $i < count($permissionIds); $i++) {
                    if (UserTypePermission::where('user_type_id', $data->id)->where('permission_id', $permissionIds[$i])->count() <= 0) {
                        $userTypePermission = new UserTypePermission;
                        $userTypePermission->user_type_id = $data->id;
                        $userTypePermission->permission_id = $permissionIds[$i];
                        $userTypePermission->save();
                    }
                }
            }

            return redirect()->back()->with('success','User Type Created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=UserType::with('user_type_permissions')->where('id','=',$id)->first();
        $permissions = Permission::permissionList(Permission::all());

        return view('user-type.edit',compact('data','permissions')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        //
        $request->validate([
            'name' => 'required',
        ]); 

        try {
            $data = UserType::find($request->user_type_id);
            $data->name = $request->name;
            $data->save();

            $permissionIds = $request->input('permissionsList');
            //-------delete previous record--------
            $deleteUserTypePermission = UserTypePermission::where('user_type_id', $request->user_type_id)->whereNotIn('permission_id', $permissionIds)->delete();
            if ($permissionIds!=null) {
                //check permission_id exitst or not...if not exist then insert
                for ($i = 0; $i < count($permissionIds); $i++) {
                    if (UserTypePermission::where('user_type_id', $request->user_type_id)->where('permission_id', $permissionIds[$i])->count() <= 0) {
                        $userTypePermission = new UserTypePermission;
                        $userTypePermission->user_type_id = $request->user_type_id;
                        $userTypePermission->permission_id = $permissionIds[$i];
                        $userTypePermission->save();
                    }
                }
            }

            return redirect()->back()->with('success','User type updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $data = UserType::find($id);
            $data->delete();
            $deleteUserTypePermission = UserTypePermission::where('user_type_id', $id)->delete();
            return redirect()->back()->with('success','User type deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with("error","Something went wrong.");
        }
    }
}
