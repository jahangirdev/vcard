<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SocialLinks;
use App\Models\Templates;
use App\Models\Portfolios;
use App\Models\Services;
use App\Models\Testimonials;
use App\Models\BusinessHours;
class Vcards extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'template', 'designation', 'slug', 'about', 'profile_img', 'cover', 'website', 'contact_email', 'address', 'phone', 'phone2', 'status', 'lang', 'show_social_icons', 'show_contact_info', 'show_services', 'show_portfolios', 'show_testimonials', 'show_business_hours', 'show_contact_form', 'qr_code', 'views'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function socialLinks(){
        return $this->belongsTo(SocialLinks::class, 'user_id', 'user_id');
    }
    public function getTemplate(){
        return $this->belongsTo(Templates::class, 'template');
    }
    public function portfolios(){
        return $this->hasMany(Portfolios::class, 'user_id', 'user_id');
    }
    public function services(){
        return $this->hasMany(Services::class, 'user_id', 'user_id');
    }
    public function testimonials(){
        return $this->hasMany(Testimonials::class, 'user_id', 'user_id');
    }
    public function businessHours(){
        return $this->belongsTo(BusinessHours::class, 'user_id', 'user_id');
    }
    public function getVcard($id){
        return $this->where('user_id', $id)->first();
    }
}
