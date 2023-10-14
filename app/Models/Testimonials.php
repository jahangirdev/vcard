<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Testimonials extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'designation', 'comment', 'user_id', 'image'];

    public function staff(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
