<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SocialLinks extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "facebook",
        "facebook_link",
        "youtube",
        "youtube_link",
        "whatsapp",
        "whatsapp_link",
        "instagram",
        "instagram_link",
        "tiktok",
        "tiktok_link",
        "snapchat",
        "snapchat_link",
        "pinterest",
        "pinterest_link",
        "reddit",
        "reddit_link",
        "linkedin",
        "linkedin_link",
        "twitter",
        "twitter_link",
        'github',
        'github_link',
        'behance',
        'behance_link',
        'dribbble',
        'dribbble_link'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
