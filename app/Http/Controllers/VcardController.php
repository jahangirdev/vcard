<?php

namespace App\Http\Controllers;

use App\Models\BusinessHours;
use App\Models\Portfolios;
use App\Models\Templates;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Models\Vcards;
use App\Models\User;
use App\Models\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class VcardController extends Controller
{
    public function index($id){
        $vcard = Vcards::where('id', $id)->with("user")->first();
        if(!$vcard){
            if(Auth::user()->role < 3){
                return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => 'Staff not found!']);
            }
            else{
                return redirect()->route('unauthorize');
            }
        }
        else if($vcard->user_id != Auth::user()->id && User::find($vcard->user_id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        $getCompany = function($id){
           return User::find($id);
        };
        $services = Services::where('user_id', $vcard->user_id)->get();
        $portfolios = Portfolios::where('user_id', $vcard->user_id)->get();
        $testimonials = Testimonials::where('user_id', $vcard->user_id)->get();
        $businessHours = BusinessHours::where('user_id', $vcard->user_id)->first();
        return view('dashboard.index-vcard', compact('vcard', 'getCompany', 'services', 'portfolios', 'testimonials', 'id', 'businessHours'));
    }

    public function create($id){
        $user = User::find($id);
        if($id != Auth::user()->id && $user->company != Auth::user()->id && Auth::user()->role != 1){
            if($user->role == 2){
                return redirect()->route('company.index')->with('notice', ['type' => 'danger', 'message' => 'You are not allowed to create vcard for this staff/comapny.']);
            }
            else{
                return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => 'You are not allowed to create vcard for this staff/company.']);
            }
        }
        if(Vcards::where('user_id', $id)->first() == null){
            $slug = Str::slug($user->name, '-');

            // Check if the slug is unique
            if(Vcards::where('slug', $slug)->exists()) {
                // If not, append a number to make it unique
                $suffix = 1;
                while(Vcards::where('slug', $slug . '-' . $suffix)->exists()) {
                    $suffix++;
                }
                $slug = $slug . '-' . $suffix;
            }
            $vcard = new Vcards([
                'user_id' => $id,
                'slug' => $slug
            ]);
            if($vcard->save()){
                $vcard = Vcards::where('user_id', $id)->first();
                return redirect()->route('vcard.edit', $vcard->id)->with('notice', ['type' => 'success', 'message' => 'Vcard created successfully. You can now edit it as you need.']);
            }
            else{
                $vcard = Vcards::where('user_id', $id)->first();
                return redirect()->route('vcard.index', $vcard->id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with creating vcard.']);
            }
        }
        else{
            if($user->role == 2){
                return redirect()->route('company.index')->with('notice', ['type' => 'danger', 'message' => 'You are not allowed to create vcard for this staff/comapny.']);
            }
            else{
                return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => 'You are not allowed to create vcard for this staff/company.']);
            }
        }
    }

    public function edit($id){
        $vcard = Vcards::with('user', 'socialLinks', 'businessHours')->find($id);
        $templates = Templates::where('status', '>', 0)->get();
        $getCompany = function ($id){
            return User::find($id);
        };
        if($vcard){
            if($vcard->user_id == Auth::user()->id || $vcard->user->company == Auth::user()->id || Auth::user()->role == 1){
                return view('dashboard.edit-vcard', compact('vcard', 'getCompany', 'templates'));
            }
            else{
                return redirect()->route('unauthorize');
            }
        }
        else{
            if(Auth::user()->role < 3){
                return redirect()->route('staff.index')->with('notice', ['type' => 'danger', 'message' => 'Vcard for the staff not found. Please create a Vcard first.']);
            }
            return redirect()->route('vcard.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong! Please try again later.']);
        }
    }
    public function update($id, Request $request){
        $vcard = Vcards::find($id);
        $request->validate([
            'designation' => 'required|string',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:vcards,slug,'.$id,
            'contact_email' => 'email',
            'about' => 'required|string|max:1200',
            'phone' => 'regex:/^(\+?\d{1,4}?)?(\d{10})$/',
            'phone2' => 'regex:/^(\+?\d{1,4}?)?(\d{10})$/',
            'address' => 'string',
            'website' => 'required|url'
        ]);
        if($vcard->user_id == Auth::user()->id || $vcard->user->company == Auth::user()->id || Auth::user()->role == 1){
            $vcard->designation = $request->designation;
            $vcard->slug = $request->slug;
            $vcard->contact_email = $request->contact_email;
            $vcard->about = $request->about;
            $vcard->phone = $request->phone;
            $vcard->phone2 = $request->phone2;
            $vcard->address = $request->address;
            $vcard->website = $request->website;
            if($vcard->save()){
                return redirect()->route('vcard.edit', $id)->with('notice', ['type' => 'success', 'message' => 'Vcard Information updated successfully!']);
            }
            else{
                return redirect()->route('vcard.edit', $id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with updating Vcard Information!']);
            }
        }
        else{
            return redirect()->route('unauthorize');
        }
    }

    public function checkSlugAvailability($id, Request $request){

        $vcard = Vcards::where('slug', $request->slug)->first();
        if(empty(trim($request->slug))){
            $data = ['type' => 'failed', 'message' => 'Slug is required!'];
        }
        else if(!$vcard){
            $data = ['type' => 'success', 'message' => 'Slug is available!'];
        }
        else{
            if($vcard->id == $id){
                $data = ['type' => 'success', 'message' => 'Slug is available!'];
            }
            else{
                $data = ['type' => 'failed', 'message' => 'Slug has been already taken!'];
            }
        }
        return response()->json($data);
    }
    public function settings($id, Request $request){
        $vcard = Vcards::find($id);
        if($vcard->user_id != Auth::user()->id && User::find($vcard->user_id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        $request->validate([
            'template' => 'nullable|integer'
        ]);
        $vcard->show_services = $request->show_services == "on" ? 1 : 0;
        $vcard->show_portfolios = $request->show_portfolios == "on" ? 1 : 0;
        $vcard->show_testimonials = $request->show_testimonials == "on" ? 1 : 0;
        $vcard->show_contact_form = $request->show_contact_form == "on" ? 1 : 0;
        $vcard->show_business_hours = $request->show_business_hours == "on" ? 1 : 0;
        $vcard->show_social_icons = $request->show_social_icons == "on" ? 1 : 0;
        $vcard->show_contact_info = $request->show_contact_info == "on" ? 1 : 0;
        $vcard->template = $request->template ? : Templates::where('status', 2)->first()->id;
        if($vcard->save()){
            return redirect()->route('vcard.edit', $id)->with('notice', ['type' => 'success', 'message' => 'Vcard settings updated successfully!']);
        }
        else{
            return redirect()->route('vcard.edit', $id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with saving Vcard settings!']);
        }
    }
    public function updateProfileImage($id, Request  $request){
        $vcard = Vcards::find($id);
        if($vcard->user_id != Auth::user()->id && User::find($vcard->user_id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        $request->validate([
            'profile_img' => 'image|mimes:jpg,png,jpeg,gif,webp|max:1024|dimensions:min_width=100,min_height=100,max_width:1000,max_height=1000'
        ]);
        if($request->file('profile_img') != null){
            $profile_img = $request->file("profile_img");
            $path = "public/image/profile/";
            $name = strtolower($vcard->slug.uniqid("", true).".".$profile_img->getClientOriginalExtension());
            if($profile_img->move($path, $name)) {
                $prevFile = $vcard->profile_img;
                $vcard->profile_img = $path.$name;
                $vcard->save();

                //delete the previous file
                $fileToDelete = public_path('../'.$prevFile);
                if (File::exists($fileToDelete)){
                    File::delete($fileToDelete);
                }
                return redirect()->route('vcard.edit', $id)->with('notice', ['message' => 'Profile image updated Successfully!', 'type' => 'success']);
            }
        }
        else{
            return redirect()->route('vcard.edit', $id)->with('notice', ['message' => 'Failed to change profile image! Please try again later or try another image.', 'type' => 'danger']);
        }
    }
    public function updateProfileCover($id, Request  $request){
        $vcard = Vcards::find($id);
        if($vcard->user_id != Auth::user()->id && User::find($vcard->user_id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        $request->validate([
            'cover' => 'image|mimes:jpg,png,jpeg,gif,webp|max:1024|dimensions:min_width=400,min_height=300,max_width=1200,max_height=800'
        ]);
        if($request->file('cover') != null){
            $cover = $request->file("cover");
            $path = "public/image/profile/";
            $name = strtolower($vcard->slug.uniqid("", true).".".$cover->getClientOriginalExtension());
            if($cover->move($path, $name)) {
                $prevFile = $vcard->cover;
                $vcard->cover = $path.$name;
                $vcard->save();

                //delete the previous file
                $fileToDelete = public_path('../'.$prevFile);
                if (File::exists($fileToDelete)){
                    File::delete($fileToDelete);
                }
                return redirect()->route('vcard.edit', $id)->with('notice', ['message' => 'Cover image updated Successfully!', 'type' => 'success']);
            }
        }
        else{
            return redirect()->route('vcard.edit', $id)->with('notice', ['message' => 'Failed to change profile cover! Please try again later or try another image.', 'type' => 'danger']);
        }
    }
    public function view($slug){
        $vcard = Vcards::where('slug', $slug)->with('getTemplate', 'portfolios', 'services', 'testimonials', 'socialLinks', 'user')->first();
        if($vcard){
            if($vcard->getTemplate && $vcard->getTemplate->status > 0){
                return view('templates.'.$vcard->getTemplate->slug, compact('vcard'));
            }
        }
        else{
            return redirect()->route('frontend.welcome');
        }
    }
}
