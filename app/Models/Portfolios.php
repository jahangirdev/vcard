<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioCategory;

class Portfolios extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'category', 'description', 'thumbnail', 'link', 'user_id'];

    public function getCategory(){
        return $this->belongsTo(PortfolioCategory::class, 'category');
    }
}
