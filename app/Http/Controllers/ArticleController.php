<?php

namespace App\Http\Controllers;

use App\Events\ArticleHit;
use App\Mail\NotifySubscriberForNewArticle;
use App\Models\Address;
use App\Models\Article;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\User;
use App\Models\Image;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::getPaginate($request);
        return view('article.list', compact('articles'));
    }

    public function show($articleId, $articleHeading = '')
    {
        $article = Article::where('id', $articleId)
            ->published()
            ->notDeleted()
            ->with([
                'user',
                'category',
                'keywords',
                'comments' => function ($comments) {
                    return $comments->published();
                },
                'comments.user',
                'comments.replies' => function ($replies) {
                    return $replies->published();
                },
                'comments.replies.user'
            ])->first();

        if (is_null($article)) {
            return redirect()->route('home')->with('warningMsg', 'Article not found');
        }
        
        $images=$this->getArticleImages($articleId);
        return view('traveller.article', compact('article','images'));
    }

    public function update(Request $request, $articleId)
    {
        $article = Article::find($articleId);
        if (is_null($article)) {
            return response()->json(['errorMsg' => 'Article not found'], Response::HTTP_NOT_FOUND);
        }

        if (!auth()->user()->can('secureAccess', $article)) {
                return redirect('/');
            }
        $updatedArticle = $request->only(['heading', 'content', 'category_id', 'language']);
        $updatedArticle['is_comment_enabled'] = $request->input('is_comment_enabled');
        $keywordsToAttach = array_unique(explode(' ', $request->get('keywords')));
        try {
            $article->update($updatedArticle);

            //remove all keywords then add all keywords from input
            $article->keywords()->detach();
            foreach ($keywordsToAttach as $keywordToAttach) {
                $newKeyword = Keyword::firstOrCreate(['name' => $keywordToAttach]);
                $article->keywords()->attach($newKeyword->id);

            }
        } catch (\PDOException $e) {
            // Log::error($this->getLogMsg($e));
            return response()->json(['errorMsg' => 'error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        session()->flash('successMsg', 'Article updated successfully!');
        return redirect()->route('get-article',$articleId);
        // return response()->json(['redirect_url' => redirect()->route('admin-articles')->getTargetUrl()]);
    }

    public function create($id=null)
    {

        $categories = Category::where('is_active', 1)->get();
        $article=null;
        $images=null;
        if($id!=null){
            $article=Article::find($id);
            if (!auth()->user()->can('secureAccess', $article)) {
                return redirect('/');
            }
            $images=$this->getArticleImages($id);
            
        }
        
        return view('traveller.create_article', compact('categories','article','images'));
    }

    public function store(Request $request)
    {

        $clientIP = $_SERVER['REMOTE_ADDR'];

        $newArticle = $request->only(['heading', 'content', 'category_id', 'language','keywords']);
        $newArticle['is_comment_enabled'] = $request->input('is_comment_enabled');
        $newAddress = ['ip' => $clientIP];

        try {
            //Create new address
            $newAddress = Address::create($newAddress);
            //Create new article
            $newArticle['address_id'] = $newAddress->id;
            $newArticle['published_at'] = new \DateTime();
            $newArticle['user_id'] = Auth::user()->id;
            $newArticle = Article::create($newArticle);
            //add keywords
            // $keywordsToAttach = array_unique(explode(',', $request->get('keywords')));
            // foreach ($keywordsToAttach as $keywordToAttach) {
            //     $newKeyword = Keyword::firstOrCreate(['name' => $keywordToAttach]);
            //     $newArticle->keywords()->attach($newKeyword->id);
            // }
            //Notify all subscriber about the new article
            // foreach (User::getSubscribedUsers() as $subscriber) {
            //     Mail::to($subscriber->email)->queue(new NotifySubscriberForNewArticle($newArticle, $subscriber));
            // }
        } catch (\PDOException $e) {
            
            // Log::error($this->getLogMsg($e));
            // return response()->json(['errorMsg' => $this->getMessage($e)], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
        return redirect()->route('edit-article',$newArticle->id);
    }

    public function togglePublish($articleId)
    {
        $article = Article::find($articleId);
        if (is_null($article)) {
            return redirect()->route('home')->with('errorMsg', 'Article not found');
        }

        if (!auth()->user()->can('secureAccess', $article)) {
            return redirect('/');
        }
        try {
            $article->update([
                'is_published' => !$article->is_published,
                'published_at' => new \DateTime(),
            ]);
        } catch (\PDOException $e) {
            Log::error($this->getLogMsg($e));
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->route('get-article',$articleId);
    }

    public function search($type,$queryString=null)
    {
        if($type=='place'){
            $articles = Article::published()->notDeleted();    
            
            if($queryString!=null && strlen($queryString)>3){
            $articles=$articles
            ->where('heading', 'LIKE', "%$queryString%")
            ->orWhere('content', 'LIKE', "%$queryString%");
            }

            $articles=$articles->latest()->paginate(9);

            $articles->getCollection()->transform(function($item, $key) {
                return [
                    'heading' =>$item->heading,
                    'img_src' =>'users/article/'.$item->images()->wherePivot('image_type','cover')->first()['src'],
                    'id'=>$item->id,
                    'd' => $item->published_at->format('d'),
                    'M' => $item->published_at->format('M'),
                    'Y' => $item->published_at->format('Y'),
                ];
            });


                $response = [
                    'pagination' => [
                        'total' => $articles->total(),
                        'per_page' => $articles->perPage(),
                        'current_page' => $articles->currentPage(),
                        'last_page' => $articles->lastPage(),
                        'from' => $articles->firstItem(),
                        'to' => $articles->lastItem()
                    ],
                    'data' => $articles
                ];
           

            return response()->json($response);
        }
        elseif ($type=='trip') {
            $trips=Trip::where('type','public');
            if($queryString!=null && strlen($queryString)>3){
            $trips=$trips
            ->where('name', 'LIKE', "%$queryString%")
            ->orWhere('start_location', 'LIKE', "%$queryString%")
            ->orWhere('end_location', 'LIKE', "%$queryString%")
            ->orWhere('description', 'LIKE', "%$queryString%");
            }
            $trips=$trips->latest()->paginate(9);
            $trips->getCollection()->transform(function($item, $key) {
                return [
                    'name' =>$item->name,
                    'img_src' =>'trip/transport.jpg',
                    'id'=>$item->id,
                    'start_time' => $item->start_time->format('Y-M-d'),
                    'end_time' => $item->end_time->format('Y-M-d'),
                    'status' => $item->status
                ];
            });


                $response = [
                    'pagination' => [
                        'total' => $trips->total(),
                        'per_page' => $trips->perPage(),
                        'current_page' => $trips->currentPage(),
                        'last_page' => $trips->lastPage(),
                        'from' => $trips->firstItem(),
                        'to' => $trips->lastItem()
                    ],
                    'data' => $trips
                ];
           

            return response()->json($response);
            
        }
    }
    public function searchUserArticles($userId,$type,$queryString=null)
    {
        if($type=='place'){
            $articles=User::find($userId)->articles()->published()->notDeleted();
            
            if($queryString!=null && strlen($queryString)>3){
            $articles=$articles
            ->where('heading', 'LIKE', "%$queryString%")
            ->orWhere('content', 'LIKE', "%$queryString%");
            }

                $articles=$articles->latest()->paginate(9);

            // $articles = $articles->map(function ($item, $key) {
            //     $item['d']=$item->published_at->format('d');
            //     $item['M']=$item->published_at->format('M');
            //     $item['Y']=$item->published_at->format('Y');
            //     return $item;
            // });
            $articles->getCollection()->transform(function($item, $key) {
                return [
                    'heading' =>$item->heading,
                    'img_src' =>'users/article/'.$item->images()->wherePivot('image_type','cover')->first()['src'],
                    'id'=>$item->id,
                    'd' => $item->published_at->format('d'),
                    'M' => $item->published_at->format('M'),
                    'Y' => $item->published_at->format('Y'),
                ];
            });


                $response = [
                    'pagination' => [
                        'total' => $articles->total(),
                        'per_page' => $articles->perPage(),
                        'current_page' => $articles->currentPage(),
                        'last_page' => $articles->lastPage(),
                        'from' => $articles->firstItem(),
                        'to' => $articles->lastItem()
                    ],
                    'data' => $articles
                ];
           

            return response()->json($response);
        }
        elseif ($type=='trip') {
            if(!Auth::guest() && Auth::user()->id==$userId){
                   $trips=User::find($userId)->trips(); 
            }
            else{
                $trips=User::find($userId)->trips()->where('type','public')->wherePivot('status', 'confirmed');        
            }    
            if($queryString!=null && strlen($queryString)>3){
            $trips=$trips
            ->where('name', 'LIKE', "%$queryString%")
            ->orWhere('start_location', 'LIKE', "%$queryString%")
            ->orWhere('end_location', 'LIKE', "%$queryString%")
            ->orWhere('description', 'LIKE', "%$queryString%");
            }
            $trips=$trips->latest()->paginate(9);
            $trips->getCollection()->transform(function($item, $key) {
                return [
                    'name' =>$item->name,
                    'img_src' =>'trip/transport.jpg',
                    'id'=>$item->id,
                    'start_time' => $item->start_time->format('Y-M-d'),
                    'end_time' => $item->end_time->format('Y-M-d'),
                    'status' => $item->status
                ];
            });


                $response = [
                    'pagination' => [
                        'total' => $trips->total(),
                        'per_page' => $trips->perPage(),
                        'current_page' => $trips->currentPage(),
                        'last_page' => $trips->lastPage(),
                        'from' => $trips->firstItem(),
                        'to' => $trips->lastItem()
                    ],
                    'data' => $trips
                ];
           

            return response()->json($response);
            
        }
    }
    
    public function destroy($articleId)
    {
        $article = Article::find($articleId);
        if (is_null($article)) {
            return redirect()->route('home')->with('errorMsg', 'Article not found');
        }

        if (!auth()->user()->can('secureAccess', $article)) {
            return redirect('/');
        }
        try {
            Article::where('id', $articleId)->update(['is_deleted' => 1]);
        } catch (\PDOException $e) {
            Log::error($this->getLogMsg($e));
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->route('create-article')->with('successMsg', 'Article deleted');
    }
    public function readMyArticle($id)
    {

        return view('traveller.article');
    }

    public function uploadImages(Request $request){
        $this->validate($request, 
                ['files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000']);
            $articleId=$request->articleId;

            $article= Article::find($articleId);
            if (!auth()->user()->can('secureAccess', $article)) {
                return response()->json(['success'=>'fail']);
            }
            foreach($request->file('files') as $key => $image)
            {
                
                $name = time().'_'.$articleId.'_'.$key.'_'.$image->getClientOriginalName();
                $destinationPath = public_path('/users').'/'.'article';
                $createdImage=Auth::user()->images()->create(['src'=> $name,
                                    'caption' =>'other',
                                    'src_type' =>'internal',
                                    'img_type'=>'article']);

                $image->move($destinationPath, $name); 
                $article->images()->attach($createdImage);
            }

            return response()->json(['type'=>"pic"]);

  
    }
    public function addOrRemoveCover($id)
    {
        $article_image=DB::table('article_image')->where('image_id',$id);
        $img_type="cover";
        if($article_image->first()->image_type=="cover"){
                $img_type="normal";
        }
        $article_image->update(['image_type'=>$img_type]);
        return response()->json(['data'=>Image::find($id)]);
    }
    private function hasArticleAuthorization($user, $article)
    {
        return $user->hasRole(['author']) && $article->user_id != $user->id;
    }

    public function getArticleImages($id){
        $images=Article::find($id)->images()->paginate(12);
            $response = [
                'pagination' => [
                    'total' => $images->total(),
                    'per_page' => $images->perPage(),
                    'current_page' => $images->currentPage(),
                    'last_page' => $images->lastPage(),
                    'from' => $images->firstItem(),
                    'to' => $images->lastItem()
                ],
                'data' => $images
            ];
       

        return response()->json($response);
    }
    public function deleteImages(Request $req){
            
            $ar=Article::find($req->article_id);
            if (!auth()->user()->can('secureAccess', $ar)) {
                return response()->json(['success'=>'fail']);
            }
            $ar->images();
            foreach ($req->images as $key => $image) {
                $ar->detach($image['id']);
                Image::where('id',$image['id'])->delete();
            }
            
    }       



}
//////////////////////////////////////////
//////////////////////////////////////////////
///////////////////////////////////////////
/*
    private function getRelatedArticles(Article $article)
    {
        return Article::where('category_id', $article->category->id)
            ->where('id', '!=', $article->id)
            ->published()
            ->latest()
            ->take(3)
            ->get();
    }

    public function edit($articleId)
    {
        $article = Article::find($articleId);
        if (is_null($article)) {
            return redirect()->route('home')->with('errorMsg', 'Article not found');
        }

        if ($this->hasArticleAuthorization(Auth::user(), $article)) {
            return redirect()->route('home')->with('errorMsg', 'Unauthorized request');
        }

        $keywords = implode(' ', $article->keywords->pluck('name')->toArray());
        $article = json_decode(json_encode($article));
        $article->keywords = $keywords;

        $categories = Category::active()->get();
        return view('admin.article.update', compact('categories', 'article','keywords'));
    }


    public function adminArticle()
    {
        $articles = Article::notDeleted()
            ->with('category', 'keywords', 'user')
            ->latest()
            ->get();
        if (Auth::user()->hasRole(['author'])) {
            $articles = $articles->where('user_id', Auth::user()->id);
        }
        return view('admin.article.list', compact('articles'));
    }    