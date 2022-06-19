<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request){
        $insert=category::insert([
            
            'name'=>$request['category_name'],
            
        ]);
        if($insert==true){
            return response()->json([
                'sts'=>'inserted',
                'msg'=>'Category created successfully'
            ]);

        }else{
            return response()->json([
                'sts'=>'failed',
                'msg'=>'there is a problem with insertion'
            ]);
        }
    }
    public function category_for_insert_page(){
       $data= category::all();
       return response()->json([
        'sts'=>'cat-data',
        'data'=>$data
       ]);
    }
}
