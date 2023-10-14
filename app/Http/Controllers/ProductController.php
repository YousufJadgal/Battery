<?php
   
namespace App\Http\Controllers;
   
use App\Models\Product;
use Illuminate\Http\Request;
use Redirect,Response,DB;
use File;
use PDF;
   
class ProductController extends Controller
{
    public function index()
    {
        return view('add');
    } 
 
    public function Product_upload(Request $req)
    {  
        $validator = Validator::make($request->all(), [
            'p_Name' => 'required',
            'p_Price' => 'required',
            'p_Category' => 'required',
            'p_Images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
    
    
          if ($validator->passes()) {
    
            $input = new product();
    

            $image=$req->file('image');
            $ext=rand().".".$image->getClientOriginalName();
            $image->move('images/',$ext);
            $input->p_Images=$ext;
        
            $input->p_Images=$ext;
            $input->save();
    
    
            AjaxImage::create($input);
    
    
            return response()->json(['success'=>'done']);
          }
    
    
          return response()->json(['error'=>$validator->errors()->all()]);
        }

}