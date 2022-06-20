<?php

namespace App\Http\Controllers;

use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request){
        $check=category::where('name',$request['category_name'])->first();
        //return response()->json($check);
        if($check){
            return response()->json([
                'sts'=>'alreday',
                'msg'=>'Alreday category exist'
            ]);
           
        }else{
            

            $insert=category::insert([
                
                'name'=>$request['category_name'],
                'created_at'=>date('Y-m-d H:i:s'),
                
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
    }
    public function category_for_insert_page(){
       $data= category::all();
       if($data->isNotEmpty()){

       
       return response()->json([
        'sts'=>'cat-data',
        'data'=>$data
       ]);
    }
    else{
        return response()->json(['sts'=>'nodata']);
    }
}
}
