<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Services extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'user_id', 'icon'];

    public function staff(){
       return $this->belongsTo(User::class, 'user_id');
    }
}
