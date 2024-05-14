<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

// class Articlee extends Model
// {
//     use HasFactory, Searchable;

//     protected $fillable = ['category_id','name','description','ordre']; // Ajoutez 'ordre' à la liste des attributs remplissables

//     // Vous pouvez également définir des relations avec d'autres modèles ici
//     public function course_category(){
//         return $this->belongsTo(CourseCategory::class,'category_id');
//     } 

//     public function user(){
//         return $this->belongsTo(User::class);
//     } 
//     public function category(){
//         return $this->belongsTo(Category::class,'category_id');
//     }
    
// }

class Articlee extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['category_id','name','description','ordre'];

    public function course_category(){
        return $this->belongsTo(CourseCategory::class);
    } 

    public function user(){
        return $this->belongsTo(User::class);
    } 

    // public function category(){
    //     return $this->belongsTo(Category::class,'category_id');
    // }
}