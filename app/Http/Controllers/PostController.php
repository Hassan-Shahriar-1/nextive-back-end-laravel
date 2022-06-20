<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post_insert(Request $request){
     
        $data=[];
        $data['title']=$request['title'];
        $data['description']=$request['description'];
        $data['category']=implode(" ",$request['categories']);
        $data['sts']=$request['sts'];
        $data['created_at']=date('Y-m-d H:i:s');
        $check=post::insert($data);
        if($check){
            return response()->json([
                'sts'=>'inserted',
                'msg'=>'Post Inserted successfully'
            ]);

        }else{
            return response()->json([
                'sts'=>'not-inserted',
                'msg'=>'There is a problem with insertion'
            ]);
        }

    }

    public function edit_post($post_id){
        $checking_post=post::where('id',$post_id)->first();
        if($checking_post){
            return response()->json([
                'sts'=>'found',
                'data'=>$checking_post
            ]);

        }else{
            return response()->json([
                'sts'=>'',
                'msg'=>'Post Not Found',
            ]);
        }

    }
    public function post_list(){
       $post_data= post::all();
       if(!empty($post_data)){
        $data=$post_data;

       }else{
        $data=null;
       }

       return response()->json([
        'sts'=>'post_data',
        'data'=>$data
       ]);
    }
    public function update_post($post_id,Request $request){
        $data=post::where('id',$post_id)->first();
        if($data){
            $data['title']=$request['title'];
            $data['description']=$request['description'];
            $data['category']=implode(' ',$request['categories']);
            $data['sts']=$request['sts'];
            $data['updated_at']=date('Y-m-d H:i:S');
            $data->save();
            return response()->json([
                'sts'=>'updated',
                'msg'=>'Post Successfully updated'
            ]);

        }else{
            return response()->json([
                'sts'=>'post_not_found',
                'msg'=>'Request Post Not Found'
            ]);
        }

    }

    public function delete_post($post_id){
       $data= post::where('id',$post_id)->first();
       if($data){
            $data->delete();
            return response()->json([
                'sts'=>'post_deleted',
                'msg'=>'Post Deleted Successfully'
            ]);

       }else{
        return response()->json([
            'sts'=>'not_found',
            'msg'=>'Request data not found'
        ]);
       }

    }

    public function post_by_category($category){
        $data=post::where('category','like','%'.$category.'%')->get();
        if(!empty($data)){
            return response()->json([
                'sts'=>'found',
                'data'=>$data
            ]);

        }else{
            return response()->json([
                'sts'=>'not-found',
                'msg'=>'No Post Found In This Category'
            ]);
        }

    }
}
