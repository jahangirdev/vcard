<?php

namespace App\Http\Controllers;

use App\Models\Vcards;
use Illuminate\Http\Request;
use App\Models\BusinessHours;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class BusinessHoursController extends Controller
{
    public function update($id, Request  $request){
        if($id != Auth::user()->id && User::find($id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        $request->validate([
            'monday' => 'nullable|string|max:255',
            'tuesday' => 'nullable|string|max:255',
            'wednesday' => 'nullable|string|max:255',
            'thursday' => 'nullable|string|max:255',
            'friday' => 'nullable|string|max:255',
            'saturday' => 'nullable|string|max:255',
            'sunday' => 'nullable|string|max:255'
        ]);
        $businessHours = BusinessHours::where('user_id', $id)->first();
        if($businessHours != null){
            $data = $request->all();
            if($businessHours->update($data)){
                return redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'success', 'message' => 'Business hours updated successfully!']);
            }
            else{
                return redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with updating business hours! Please try again later.']);
            }
        }
        else{
            $data = $request->all();
            $data['user_id'] = $id;
            $businessHours = new BusinessHours($data);
            if($businessHours->save()){
                return redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'success', 'message' => 'Business hours updated successfully!']);
            }
            else{
                return redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with updating business hours! Please try again later.']);
            }
        }
    }
}
