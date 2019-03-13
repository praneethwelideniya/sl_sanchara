<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Mail\CommentConfirmation;
use App\Mail\NotifyAdmin;
use App\Mail\NotifyCommentThread;
use App\Models\Address;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Trip;
use App\Models\Config;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function getComments($id,$type){
        $auth_user_id=0;
        $asset_user=false;
        if(auth()->check()){
            $auth_user_id=auth()->user()->id;
        }
        if($type=='article'){
            $article=Article::find($id);
            $comments=$article->comments;
            if($article->user_id==$auth_user_id){
                $asset_user=true;
            }
        }
        elseif ($type=='trip') {
            $trip=Trip::find($id);
            $comments=$trip->comments;
            if(!is_null($trip->users()->find($auth_user_id))){
                $asset_user=true;
            }
        }
        $res=[];
        
        foreach ($comments as $key => $comment) {
            $rep=[];
            if($comment->comments!=null){
                foreach ($comment->comments as $rep_key => $reply) {
                    $rep[$rep_key] =['id'=>$reply->id,'comment'=>$reply->comment,'user_name'=>$reply->commented->name,'user_id'=>$reply->commented->id,'updated_at'=>$reply->updated_at->format('M d, Y'),'user_img'=>$reply->commented->profileImage->src, 'auth'=> $auth_user_id==$reply->commented->id?true:false,'asset_user'=>$asset_user];   
                }
            }
            $res[$key]=['id'=>$comment->id,'comment'=>$comment->comment,'user_name'=>$comment->commented->name,'user_id'=>$comment->commented->id,'updated_at'=>$comment->updated_at->format('M d, Y'),'user_img'=>$comment->commented->profileImage->src,'replies'=>$rep, 'auth'=> $auth_user_id==$comment->commented->id?true:false,'asset_user'=>$asset_user];
        }
        return response()->json($res);
    }

    public function addComment(Request $req){
        $user=Auth::user();
        switch ($req->asset) {
            case 'article':
                $article=Article::find($req->id);
                $user->comment($article, $req->comment);
                break;
            case 'comment':
                $com=Comment::find($req->id);
                $user->comment($com, $req->comment);
                break;
            case 'trip':
                $trip=Trip::find($req->id);
                $user->comment($trip, $req->comment);
                break;    
            default:
                return response()->json(['success'=>'funcsd']);
                break;
        }
        return response()->json(['success'=>true]);
    }

    public function deleteComment(Request $req){
        $comment=Auth::user()->comments()->find($req->id);
        $commentable=null;
        if($req->asset_type=='article'){
            $commentable=Comment::find($req->id)->commentable->user->find(auth()->user()->id);
        }
        if ($req->asset_type=='trip') {
            $commentable=Comment::find($req->id)->commentable->users->find(auth()->user()->id);
        }
        if($req->asset_type=='comment'){
            $commentable=Comment::find($req->id)->commentable->commented->find(auth()->user()->id);
        }
        if(!is_null($comment) || !is_null($commentable)){
            Comment::find($req->id)->delete();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);

    }

    public function updateComment(Request $req){
        $comment=Auth::user()->comments()->find($req->id);
        if(!is_null($comment)){
            $comment->comment=$req->comment;
            $comment->save();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);   
    }
}
