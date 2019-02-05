<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $unsplash  = new \MahdiMajidzadeh\LaravelUnsplash\Photo();
        // $photos    = $unsplash->random(['query'=>"Sri Lanka Lk ceylon sigiriya ella dunhida diyaluma",'orientation'=>'landscape','count'=>4])->get();
        $photos=null;
        // if (Auth::check()) {
        //     $dashboard = new DashboardController();
        //     return $dashboard->index();
        // } else {
        //     $articles = Article::getPaginate($request);
        //     return view('frontend.articles', compact('articles'));
        // }

        return view('welcome',compact('photos'));
    }
}
