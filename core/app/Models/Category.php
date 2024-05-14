<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;

class Category extends Model
{
    use HasFactory, GlobalStatus, Searchable;
    

    public function products(){
        return $this->hasMany(Product::class);
    }
    
}
