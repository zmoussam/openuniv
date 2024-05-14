<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CoursecategoryController extends Controller
{

public function all()
{
    $pageTitle = 'All Categories';
    // Récupérez toutes les catégories triées par ordre croissant
    $categories = CourseCategory::orderBy('ordre', 'asc')->searchable(['name'])->with('articles')->paginate(getPaginate());
    return view('admin.Coursecategory.all', compact('pageTitle', 'categories'));
}
    
    public function add(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|max:255|unique:course_categories,name',
        'ordre' => 'nullable|integer|min:1', // L'ordre est facultatif et doit être un entier positif
    ]);
    
    // Vérifier si un ordre est spécifié
    if ($request->filled('ordre')) {
        // Si un ordre est spécifié, vérifier s'il existe déjà une catégorie avec cet ordre
        $existingCategory = CourseCategory::where('ordre', $request->ordre)->first();
        if ($existingCategory) {
            // Si une catégorie avec cet ordre existe, réorganiser les ordres des catégories existantes
            CourseCategory::where('ordre', '>=', $request->ordre)->increment('ordre');
        }
    } else {
        // Si aucun ordre spécifié, attribuer l'ordre actuel + 1
        $request['ordre'] = CourseCategory::count() + 1;
    }

    // Créer une nouvelle catégorie
    $category = new CourseCategory;
    $category->name = $request->name;
    $category->ordre = $request->ordre;

    // Enregistrer la catégorie
    $category->save();

    // Retourner avec une notification de succès
    $notify[] = ['success', 'Category added successfully'];
    return back()->withNotify($notify);
}


      
      
public function update(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'id' => 'required|exists:course_categories,id',
        'name' => 'required|max:255|unique:course_categories,name,' . $request->id,
        'ordre' => 'nullable|integer|min:1', // L'ordre est facultatif et doit être un entier positif
    ]);

    // Récupérer la catégorie à modifier
    $category = CourseCategory::findOrFail($request->id);

    // Mettre à jour les autres catégories si l'ordre est modifié
    if ($request->filled('ordre') && $request->ordre != $category->ordre) {
        $newOrder = $request->ordre;

        // Réorganiser les ordres des catégories existantes
        CourseCategory::where('id', '!=', $category->id)
                      ->where('ordre', '>=', $newOrder)
                      ->increment('ordre');
    }

    // Mettre à jour la catégorie
    $category->name = $request->name;
    $category->ordre = $request->filled('ordre') ? $request->ordre : $category->ordre; // Utiliser la nouvelle valeur de l'ordre si elle est fournie, sinon garder l'ancienne valeur
    $category->save();

    // Retourner avec une notification de succès
    $notify[] = ['success', 'Category updated successfully'];
    return back()->withNotify($notify);
}


	private function formSubmit(Request $request,$update = false){
		$request->validate([
			'name' => 'required|max:255|unique:course_categories,name',
			'ordre' => 'nullable|integer|min:1', // Validation du champ ordre
		      ]);
		  
		      if ($update) {
			$category = CourseCategory::findOrFail($request->id);
		      } else {
			$category = new CourseCategory;
		      }
		  
		      $category->name = $request->name;
		      $category->ordre = $request->ordre; // Assigner la valeur du champ ordre
		      $category->save();
		  
		      return $category;

		if($update){
		$category = CourseCategory::findOrFail($request->id);
		} else {
		$category = new CourseCategory;
		}

		$category->name = $request->name;
		$category->save();

		return $category;

		if($update){
			$rule['id'] = 'required|integer';
		}
	
		$request->validate($rule);
	
		if($update){
			$category = CourseCategory::findOrFail($request->id); 
		}else{
			$category = new CourseCategory; 
		}
		
    	$category->name = $request->name;
    	$category->save();

		return $category;
	}

	public function status($id){ 
		return CourseCategory::changeStatus($id);
	}

	public function delete($id){ 
		$category = CourseCategory::whereDoesntHave('articles')->findOrFail($id);
		$category->delete();

		$notify[] = ['success', 'Category deleted successfully'];
	    return back()->withNotify($notify);
	}

}
