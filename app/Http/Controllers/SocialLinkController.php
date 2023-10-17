<?php

namespace App\Http\Controllers;

use App\Models\Vcards;
use Illuminate\Http\Request;
use App\Models\SocialLinks;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SocialLinkController extends Controller
{
    public function update($id, Request $request){
        $request->validate([
            'facebook' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'facebook_link' => 'nullable|string|url',
            'youtube' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'youtube_link' => 'nullable|string|url',
            'whatsapp' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'whatsapp_link' => 'nullable|string|url',
            'instagram' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'instagram_link' => 'nullable|string|url',
            'tiktok' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'tiktok_link' => 'nullable|string|url',
            'snapchat' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'snapchat_link' => 'nullable|string|url',
            'pinterest' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'pinterest_link' => 'nullable|string|url',
            'reddit' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'reddit_link' => 'nullable|string|url',
            'linkedin' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'linkedin_link' => 'nullable|string|url',
            'twitter' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'twitter_link' => 'nullable|string|url',
            'github' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'github_link' => 'nullable|string|url',
            'behance' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'behance_link' => 'nullable|string|url',
            'dribbble' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_@]+$/',
            'dribbble_link' => 'nullable|string|url',
        ]);
        $socialLinks = SocialLinks::where('user_id', $id)->first();
        if(Auth::user()->id != $id && User::find($id)->company != Auth::user()->id && Auth::user()->role != 1){
            return redirect()->route('unauthorize');
        }
        if($socialLinks == null){
            $socialLinks = new SocialLinks();
            $socialLinks->user_id = $id;
        }
        $socialLinks->facebook = $request->facebook;
        $socialLinks->facebook_link = $request->facebook_link;
        $socialLinks->youtube = $request->youtube;
        $socialLinks->youtube_link = $request->youtube_link;

        $socialLinks->whatsapp = $request->whatsapp;
        $socialLinks->whatsapp_link = $request->whatsapp_link;

        $socialLinks->instagram = $request->instagram;
        $socialLinks->instagram_link = $request->instagram_link;

        $socialLinks->tiktok = $request->tiktok;
        $socialLinks->tiktok_link = $request->tiktok_link;

        $socialLinks->snapchat = $request->snapchat;
        $socialLinks->snapchat_link = $request->snapchat_link;

        $socialLinks->pinterest = $request->pinterest;
        $socialLinks->pinterest_link = $request->pinterest_link;

        $socialLinks->reddit = $request->reddit;
        $socialLinks->reddit_link = $request->reddit_link;

        $socialLinks->linkedin = $request->linkedin;
        $socialLinks->linkedin_link = $request->linkedin_link;

        $socialLinks->twitter = $request->twitter;
        $socialLinks->twitter_link = $request->twitter_link;

        $socialLinks->github = $request->github;
        $socialLinks->github_link = $request->github_link;

        $socialLinks->behance = $request->behance;
        $socialLinks->behance_link = $request->behance_link;

        $socialLinks->dribbble = $request->dribbble;
        $socialLinks->dribbble_link = $request->dribbble_link;
        if($socialLinks->save()){
            return  redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'success', 'message' => 'Social links updated successfully!']);
        }
        else{
            return redirect()->route('vcard.edit', Vcards::where('user_id', $id)->first()->id)->with('notice', ['type' => 'danger', 'message' => 'Something went wrong with updating social links! Please try again later.']);
        }
    }
}
