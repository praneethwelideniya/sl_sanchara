<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
class AdminController extends Controller
{
    public function viewBlog(){
    	return view('admin.blog.view',['blogs'=>Blog::all()]);
    }
}
