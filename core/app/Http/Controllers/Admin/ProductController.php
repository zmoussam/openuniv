<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductDetail;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller{

    public function all(){
        $pageTitle = 'All Products';
        $products = Product::searchable(['name', 'category:name'])->filter(['category_id'])->orderBy('id', 'DESC')->with('category', 'productDetails')->paginate(getPaginate());
        return view('admin.product.all',compact('pageTitle', 'products'));
    }

    public function form($id = null){ 

        $pageTitle = 'Add Product';
        $formAction = route('admin.product.add');

        if($id){
            $pageTitle = 'Update Product';
            $formAction = route('admin.product.update');
        }
		
        $categories = Category::active()->get();
		$product = Product::find($id);

		$product_attr = ProductAttributes::get();
		
        return view('admin.product.form',compact('pageTitle', 'categories', 'product', 'formAction','product_attr'));
    }
    
    public function add(){
		
		$this->formSubmit();

    	$notify[] = ['success', 'Product added successfully'];
	    return back()->withNotify($notify);
    }

	public function update(){

		$this->formSubmit(update:true);

    	$notify[] = ['success', 'Product updated successfully'];
	    return back()->withNotify($notify);
    }

	private function formSubmit($update = false){
		
		$request = request();
		//dd($request);
		$rule = [
    		'category_id' => 'required|integer',
    		'name' => 'required',
    		'price' => 'required|numeric|min:0',
    		'description' => 'nullable',
    		'expiry_period' => 'required'
    	];

		if($update){
			$rule['id'] = 'required|integer';
			#$rule['file'] = ['nullable', new FileTypeValidate(['txt'])];
			$rule['image'] = ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])];
		}else{
			#$rule['file'] = ['required', new FileTypeValidate(['txt'])];
			$rule['image'] = ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])];
		}

		$request->validate($rule);
        $category = Category::active()->findOrFail($request->category_id);

		if($update){
			$product = Product::findOrFail($request->id); 
		}else{
			$product = new Product; 
		}

		$purifier = new \HTMLPurifier();
		$description = htmlspecialchars_decode($purifier->purify($request->description));
		
    	$product->category_id = $category->id;
    	$product->name = $request->name;
    	$product->price = $request->price; 
    	$product->description = $description;
    	$product->expiry_period = $request->expiry_period;
	
    	$product->attr = (isset($request->attr)&& $request->attr!= null)? json_encode($request->attr) : null;

    	$product->name_lang = (isset($request->name_lang)&& $request->name_lang!= null)? json_encode(array_content_to_html($request->name_lang)) : null;
    	$product->description_lang = (isset($request->description_lang)&& $request->description_lang!= null)? json_encode(array_content_to_html($request->description_lang)) : null;

        if ($request->hasFile('image')) {
            try {
                $old = $product->image;
                $product->image = fileUploader($request->image, getFilePath('product'), getFileSize('product'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
		
		/* if($request->hasFile('file')){
			$file = $request->file('file');
			$fileContents = file_get_contents($file->path());
			$lines = explode("\n", $fileContents);
			$lines = array_filter($lines);
			
			foreach($lines as $line){
				$details = new ProductDetail();
				$details->product_id = $product->id;
				$details->details = $line;
				$details->save();
			}
		} */
		
		
		$product->save();
		return $product;
	}

	public function status($id){ 
		return Product::changeStatus($id);
	}
	

	public function downloadDemoTxt(){

		$text = 'Username:username | Password:username';
		$content = "$text\n$text\n";
		$filename = 'demo_format.txt';

		$headers = [
			'Content-Disposition' => 'attachment; filename="' . $filename . '"',
			'Content-Type' => 'text/plain',
		];

		return new Response($content, 200, $headers);
	}

	public function accounts($id){
		$product = Product::findOrFail($id);
        $pageTitle = strLimit($product->name, 50)." - In Stock($product->in_stock)";
        $accounts = ProductDetail::where('product_id', $product->id)->searchable(['details'])->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.account',compact('pageTitle', 'accounts'));
	}

	public function deleteAccount($id){
		$accountDetails = ProductDetail::unSold()->findOrFail($id);
		$accountDetails->delete();

		$notify[] = ['success', 'Account deleted successfully'];
	    return back()->withNotify($notify);
	}

	public function updateAccount(Request $request){

		$request->validate([
			'id'=>'required'
		]);

		$accountDetails = ProductDetail::findOrFail($request->id);
		$accountDetails->details = $request->details;
		$accountDetails->save();

		$notify[] = ['success', 'Account details updated successfully'];
	    return back()->withNotify($notify);
	}


	function all_attr(){
		$pageTitle = "All attr";
        $productAttributes = ProductAttributes::all();
        return view('admin.product.all_attr',compact('pageTitle','productAttributes'));
	}

	function add_attr(Request $request){
		$request->validate([
			'name'=>'required',
			'status'=>'required',
			'description'=>'required',
			'attr'=> 'nullable',
			'attr_id'=>'numeric|nullable'
		]);

		//dd($request);

		if (isset($request->attr_id)) {
			$attributes = ProductAttributes::where('id' , ($request->attr_id ?? 0))->first();
		}else{
			$attributes = new ProductAttributes();
		}

		//$attr_lang = json_decode($request->attr);

		$attributes->name = $request->name;
		$attributes->description = $request->description;
		$attributes->status = ($request->status == '1') ? 1 : 0;
		$attributes->lang = (isset($request->attr) && ($request->attr!=null)) ? json_encode($request->attr) : json_encode([]);

		$attributes->save();

		$notify[] = ['success', 'Attributes added successfully'];
	    return back()->withNotify($notify);
	}


	function form_attr($id){
		$pageTitle = "edit attr";
        $productAttributes = ProductAttributes::where('id',$id)->first();
		if(!$productAttributes):
			$notify[] = ['error', 'Attributes dosn\'t existe '];
			return back()->withNotify($notify);
		endif;
        return view('admin.product.form_attr',compact('pageTitle','productAttributes'));
	} 

}
