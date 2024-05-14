<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Models\Articlee;

class ArticleController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Retrieve articles matching the search query
        $articles = Articlee::where('name', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%")
                           ->limit(5)
                           ->get();
                           
        // Retrieve all categories
        $categories = CourseCategory::all();

        // Pass both articles and categories to the view
        return view('knowledgebase.results', compact('articles', 'categories'));
    }

}