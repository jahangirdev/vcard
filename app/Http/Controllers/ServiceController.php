<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = null;
        if(Auth::user()->role == 1){
            $services = Services::all();
        }
        else if(Auth::user()->role == 2){
            $stuff_ids = User::where('company', Auth::user()->id)->pluck('id')->toArray();
            $services = Services::where('user_id', $stuff_ids)->get();
        }
        else{
            $services = Services::where('user_id', Auth::user()->id)->get();
        }
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view('dashboard.index-service', compact('services', 'getCompany'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = Auth::user()->role == 1 ? User::where('role', '>', 1)->get() : User::where('company', Auth::user()->id)->get();
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view("dashboard.create-service", compact('staffs', 'getCompany'));
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
            'title' => 'required|string|max:255|',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:services',
            'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512|dimensions:max_width=400,max_height=400',
            'description' => 'nullable|string',
        ]);
        $user_id = $request->user_id ? : Auth::user()->id;
        $user_id = Auth::user()->role == 1 ? $user_id : User::find($user_id)->company == Auth::user()->id ? $user_id : Auth::user()->id;
        $icon = $request->file("icon");
        $path = "public/image/";
        $name = strtolower($request->slug.uniqid("", true).".".$icon->getClientOriginalExtension());
        if($icon->move($path, $name)){
            $service = new Services([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'icon' => $path.$name,
                'user_id' => $user_id,
            ]);
            $service->save();
            return redirect()->route('service.index')->with('notice', ['message' => 'Service created Successfully!', 'type' => 'success']);
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
        $service = Services::find($id);
        $staffs = Auth::user()->role == 1 ? User::where('role', '>', 1)->get() : User::where('company', Auth::user()->id)->get();
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view('dashboard.edit-service', compact('service', 'staffs', 'getCompany'));
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
        $request->validate([
            'title' => 'required|string|max:255|',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:services,slug,'.$id,
            'icon' => $request->file('icon') !== null ? 'image|mimes:jpg,png,jpeg,gif,svg|max:512|dimensions:max_width:400,max_height=400':"",
            'description' => 'string'
        ]);
        $user_id = $request->user_id != null && Auth::user()->role == 1 ? $request->user_id : User::find($request->user_id)->company == Auth::user()->id ? $request->user_id : Services::find($id)->user_id;
        if($request->file('icon') != null){
            $icon = $request->file("icon");
            $path = "public/image/";
            $name = strtolower($request->slug.uniqid("", true).".".$icon->getClientOriginalExtension());
            if($icon->move($path, $name)) {
                $service = Services::find($id);
                $prevFile = $service->icon;
                $service->title = $request->title;
                $service->slug = $request->slug;
                $service->description = $request->description;
                $service->icon = $path . $name;
                $service->user_id = $user_id;
                $service->save();

                //delete the previous file
                $fileToDelete = public_path('../'.$prevFile);
                if (File::exists($fileToDelete)){
                    File::delete($fileToDelete);
                }
                return redirect()->route('service.index')->with('notice', ['message' => 'Service updated Successfully!', 'type' => 'success']);
            }
            else{
                return redirect()->route('service.index')->with('notice', ['message' => 'There is an issue with uploading icon!', 'type' => 'danger']);
            }
        }
        else{
            $service = Services::find($id);
            $service->title = $request->title;
            $service->slug = $request->slug;
            $service->description = $request->description;
            $service->user_id = $user_id;
            $service->save();
            return redirect()->route('service.index')->with('notice', ['message' => 'Service updated Successfully!', 'type' => 'success']);
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
        Services::destroy($id);
        return redirect()->route('service.index')->with('notice', ['type' => 'warning', 'message' => 'Service deleted successfully!']);
    }
}
