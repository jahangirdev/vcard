<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templates;
use Illuminate\Support\Facades\Auth;
class TemplateController extends Controller
{
    public function index(){
        $templates = Templates::all();
        return view('dashboard.index-template', compact('templates'));
    }
    public function preview($id){
        $template = Templates::find($id);
        if($template->status == 1 || Auth::user()->role == 1)
            return view('templates.'.$template->view);
        else
            return view('dashboard.unauthorize');
    }
    public function enable($id){
        $template = Templates::find($id);
        $template->status = 1;
        if($template->save()){
            return redirect()->route('template.index')->with('notice', ['type' => 'success', 'message' => 'Template "'.$template->name.'" enabled successfully']);
        }
        else{
            return redirect()->route('template.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong! please try again later.']);
        }
    }
    public function disable($id){
        $template = Templates::find($id);
        if($template->status == 2){
            return redirect()->route('template.index')->with('notice', ['type' => 'danger', 'message' => 'Default template cannot be disabled! Please set another template as a default template first.']);
        }
        else{
            $template->status = 0;
            if($template->save()){
                return redirect()->route('template.index')->with('notice', ['type' => 'warning', 'message' => 'Template "'.$template->name.'" disabled successfully']);
            }
            else{
                return redirect()->route('template.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong! please try again later.']);
            }
        }
    }
    public function default($id){
        //check if the template is enabled
        $template = Templates::find($id);
        if($template->status == 0){
            return redirect()->route('template.index')->with('notice', ['type' => 'danger', 'message' => 'Disabled template cannot be set as default! Please enable the template first.']);
        }
        //remove default status form all other templates
        $templates = Templates::where('status', 2)->get();
        foreach($templates as $tem){
            $tem->status = 1;
            $tem->save();
        }
        $template->status = 2;
        if($template->save()){
            return redirect()->route('template.index')->with('notice', ['type' => 'success', 'message' => '"'.$template->name.'" has been successfully set as default template!']);
        }
        else{
            return redirect()->route('template.index')->with('notice', ['type' => 'danger', 'message' => 'Something went wrong! please try again later.']);
        }
    }
}
