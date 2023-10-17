<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Auth::user()->role == 1 ? User::where('role', 3)->with('vcard')->get() : User::where('company', Auth::user()->id)->with('vcard')->get();
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view('dashboard.index-staff', compact('staffs', 'getCompany'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = User::where('role', 2)->get();
        return view('dashboard.create-staff', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company' => Auth::user()->role == 1 ? 'required|integer' : '',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3,
            'company' => Auth::user()->role == 1 ? $request->company : Auth::user()->id,
        ]);
        $user->save();
        return redirect()->route('staff.index')->with('notice', ['type' => 'success', 'message' => 'Staff registered successfully!']);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::find($id)->company == Auth::user()->id || Auth::user()->role == 1 ){
            if(User::destroy($id)) {
                return redirect()->route('staff.index')->with('notice', ['type' => 'warning', 'message' => 'Staff deleted successfully!']);
            }
            else{
                return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong!. Please try again later.']);
            }
        }
        else{
            return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => "You don't have permission to delete this staff"]);
        }
    }
}
