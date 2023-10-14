<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonials;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 1){
            $testimonials = Testimonials::all();
        }
        else if(Auth::user()->role == 2){
            $stuff_ids = User::where('company', Auth::user()->id)->pluck('id')->toArray();
            $testimonials = Testimonials::where('user_id', $stuff_ids)->get();
        }
        else{
            $testimonials = Testimonials::where('user_id', Auth::user()->id)->get();
        }
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view('dashboard.index-testimonial', compact('testimonials', 'getCompany'));
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
        return view("dashboard.create-testimonial", compact('staffs', 'getCompany'));
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
            'name' => 'required|string|max:255|',
            'designation' => 'string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:512|dimensions:max_width=400,max_height=400',
            'comment' => 'required|string',
        ]);
        $user_id = $request->user_id != null && Auth::user()->role == 1 ? $request->user_id : User::find($request->user_id)->company == Auth::user()->id ? $request->user_id : Auth::user()->id;
        $image = $request->file("image");
        $path = "public/image/";
        $name = strtolower($request->slug.uniqid("", true).".".$image->getClientOriginalExtension());
        if($image->move($path, $name)){
            $testimonial = new Testimonials([
                'name' => $request->name,
                'designation' => $request->designation,
                'comment' => $request->comment,
                'image' => $path.$name,
                'user_id' => $user_id,
            ]);
            $testimonial->save();
            return redirect()->route('testimonial.index')->with('notice', ['message' => 'Testimonial created Successfully!', 'type' => 'success']);
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
        $testimonial = Testimonials::find($id);
        $staffs = Auth::user()->role == 1 ? User::where('role', '>', 1)->get() : User::where('company', Auth::user()->id)->get();
        $getCompany = function ($user_id){
            return User::find($user_id);
        };
        return view('dashboard.edit-testimonial', compact('testimonial', 'staffs', 'getCompany'));
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
            'name' => 'required|string|max:255|',
            'designation' => 'string',
            'image' => $request->file('icon') !== null ? 'image|mimes:jpg,png,jpeg,gif|max:512|dimensions:max_width:400,max_height=400':"",
            'comment' => 'required|string'
        ]);
        $user_id = $request->user_id != null && Auth::user()->role == 1 ? $request->user_id : User::find($request->user_id)->company == Auth::user()->id ? $request->user_id : Services::find($id)->user_id;
        if($request->file('image') != null){
            $image = $request->file("image");
            $path = "public/image/";
            $name = strtolower($request->slug.uniqid("", true).".".$image->getClientOriginalExtension());
            if($image->move($path, $name)) {
                $testimonial = Testimonials::find($id);
                $prevFile = $testimonial->image;
                $testimonial->name = $request->name;
                $testimonial->designation = $request->designation;
                $testimonial->comment = $request->comment;
                $testimonial->image = $path . $name;
                $testimonial->user_id = $user_id;
                $testimonial->save();

                //delete the previous file
                $fileToDelete = public_path('../'.$prevFile);
                if (File::exists($fileToDelete)){
                    File::delete($fileToDelete);
                }
                return redirect()->route('testimonial.index')->with('notice', ['message' => 'Testimonial updated Successfully!', 'type' => 'success']);
            }
            else{
                return redirect()->route('testimonial.index')->with('notice', ['message' => 'There is an issue with uploading image!', 'type' => 'danger']);
            }
        }
        else{
            $service = Testimonials::find($id);
            $service->name = $request->name;
            $service->designation = $request->designation;
            $service->comment = $request->comment;
            $service->user_id = $user_id;
            $service->save();
            return redirect()->route('testimonial.index')->with('notice', ['message' => 'Testimonial updated Successfully!', 'type' => 'success']);
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
        if(Testimonials::destroy($id)) {
            return redirect()->route('testimonial.index')->with('notice', ['type' => 'warning', 'message' => 'Testimonial deleted successfully!']);
        }
        else{
            return redirect()->route('testimonial.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong!. Please try again later.']);
        }
    }
}
