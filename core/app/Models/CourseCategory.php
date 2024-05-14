<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
class CourseCategory extends Model
{ 
    protected $fillable = ['name', 'ordre']; 
    use HasFactory, GlobalStatus, Searchable;

    public function articles(){
        return $this->hasMany(Articlee::class);
    }
}
