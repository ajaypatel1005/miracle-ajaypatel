<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userTypes=UserType::get();
        return view('users.create',compact('userTypes'));
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
        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'contact_no' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]); 
                try {
                    $data = new User();
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->user_type_id = $request->user_type;
                    $data->contact_no = $request->contact_no;
                    $data->password =Hash::make($request->password);
                    $data->save();
                    
                    return redirect()->back()->with('success','User Created successfully');
                } catch (Exception $e) {
                    return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=User::where('id','=',$id)->first();
        $userTypes=UserType::get();
        return view('users.edit',compact('data','userTypes'));
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {
        //
        $data=User::with('user_types')->where('id','=',Auth::user()->id)->first();
        return view('auth.profile',compact('data'));
    }

    

    public function updateProfile(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'contact_no' => 'required',
        ]); 
        // dd($request->all());
        try {
            $user = User::find($request->user_id);
                $user->name = $request->name;
                $user->contact_no = $request->contact_no;
                $user->save();
            
            return redirect()->back()->with('success','User updated successfully');
            
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $id)
    {
        //
        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required|email|max:255',
            'contact_no' => 'required',
        ]); 
        // dd($request->all());
        try {
            $user = User::find($request->user_id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type_id = $request->user_type;
                $user->contact_no = $request->contact_no;
                $user->save();
            
            return redirect()->back()->with('success','User updated successfully');
            
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->input())->with("error","Error..Please try again.".$e);
        }
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
        try {
            $user = User::find($id);
           
            if ($user == true) {
                $user = $user->delete();
                return redirect()->back()->with('success','User deleted successfully');
            } else {
                
                return redirect()->back()->with('error','Sorry!! User not exist.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong!!');
        }
    }
}
