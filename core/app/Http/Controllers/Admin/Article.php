<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articlee;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class Article extends Controller
{
    //ajouter ordre 
    // public function all()
    // {
    //     $pageTitle = 'All Articles';
    //     $articles = Articlee::searchable(['name', 'course_category:name'])
    //                         ->filter(['course_category_id'])
    //                         ->orderBy('course_category_id')
    //                         ->orderBy('ordre') // Ajoutez cette ligne pour trier par ordre croissant
    //                         ->paginate(getPaginate());
    //     return view('admin.article.all', compact('pageTitle', 'articles'));
    // }

    public function all(Request $request)
{
    $pageTitle = 'All Articles';
    $search = $request->input('search');

    $articles = Articlee::searchable(['name', 'course_category:name'])
                        ->filter(['course_category_id'])
                        ->when($search, function ($query, $search) {
                            $query->where('name', 'like', "%{$search}%");
                        })
                        ->orderBy('course_category_id')
                        ->orderBy('ordre')
                        ->paginate(getPaginate());

    return view('admin.article.all', compact('pageTitle', 'articles'));
}

    
    public function form($id = null)
{
    $pageTitle = $id ? 'Update Article' : 'Add Article';
    $formAction = $id ? route('admin.article.update') : route('admin.article.add');

    $course_categories = CourseCategory::get();
    $article = Articlee::find($id);

    // Passer les informations sur la catégorie et l'ordre à la vue lors de l'édition
    $category_id = null;
     $order = null;
    if ($article) {
        $category_id = $article->course_category_id;
        $order = $article->ordre;
    }

    return view('admin.article.form', compact('pageTitle', 'course_categories', 'article', 'formAction', 'category_id', 'order'));
}

    public function add()
    {
        $this->formSubmit();
        $notify[] = ['success', 'Article added successfully'];
        return back()->withNotify($notify);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////
//     public function search(Request $request)
// {
//     $search = $request->input('search');
//     // $artecle = Articlee::searchable(['name', 'category:name'])->filter(['category_id'])->orderBy('id', 'DESC')->with('category', 'productDetails')->paginate(getPaginate());
//     $artecle = Articlee::searchable(['name'])->where('name', 'like', "%{$search}%")->get();
//     $products = Articlee::searchable(['name', 'category:name'])->filter(['category_id'])->orderBy('id', 'DESC')->with('category', 'productDetails')->paginate(getPaginate());


//     return view('knowledge', compact('artecle'));
// }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function update()
    {
        $this->formSubmit(update: true);
        $notify[] = ['success', 'Article updated successfully'];
        return back()->withNotify($notify);
    }
//ajouter  ordre
    private function formSubmit($update = false)
{

    $request = request();
    $rule = [
        'course_category_id' => 'required|integer',
        'name' => 'required',
        'description' => 'required'
    ];


    $request->validate($rule);
    $category = CourseCategory::findOrFail($request->course_category_id);

    if ($update) {
        $article = Articlee::findOrFail($request->id);
    } else {
        $article = new Articlee;
    }

    $purifier = new \HTMLPurifier();
    $description = htmlspecialchars_decode($purifier->purify($request->description));

    $article->course_category_id = $category->id;
    $article->name = $request->name;
    $article->description = $description;

    // Récupérer l'ordre à partir du formulaire ou calculer le prochain ordre si non spécifié
    $order = $request->filled('ordre') ? $request->ordre : $category->articles()->count() + 1;

    // Assurez-vous que l'ordre commence à 1 si aucun article n'existe encore dans la catégorie
    $order = max(1, $order);

    // Vérifier si l'ordre existe déjà pour un autre article dans la même catégorie
    $existingArticle = $category->articles()->where('ordre', $order)->first();

    // Si un article existe déjà avec le même ordre, ajuster les ordres des autres articles de la catégorie
    if ($existingArticle) {
        $category->articles()->where('ordre', '>=', $order)->increment('ordre');
    }

    $article->ordre = $order;

    if ($request->hasFile('image')) {
        try {
            $old = $article->image;
            $article->image = fileUploader($request->image, getFilePath('article'), getFileSize('article'), $old);
        } catch (\Exception $exp) {
            $notify[] = ['error', 'Couldn\'t upload your image'];
            return back()->withNotify($notify);
        }
    }
    $article->save();
}

    


    public function delete($id)
    {
        $category = Articlee::findOrFail($id);
        $category->delete();

        $notify[] = ['success', 'Article deleted successfully'];
        return back()->withNotify($notify);
    }
}
