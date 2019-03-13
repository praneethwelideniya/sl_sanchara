<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/', 'HomeController@index')->name('home');

//Authentication
Route::get('register', 'AuthController@showRegistrationForm')->name('register-form')->middleware('guest');
Route::post('register', 'UserController@store')->name('register')->middleware('guest');
Route::get('login', 'AuthController@showLoginForm')->name('login-form')->middleware('guest');
Route::post('admin/login', 'AuthController@login')->name('login')->middleware('guest');
Route::get('/user/verify/{token}', 'AuthController@verifyUser')->middleware('guest');
Route::get('admin/logout', 'AuthController@logout')->name('logout')->middleware('auth');


//Article
Route::get('article', 'ArticleController@index')->name('articles');
Route::get('article/{articleId}/{articleHeading?}', 'ArticleController@show')->name('get-article');
Route::get('category/article/{categoryAlias}', 'CategoryController@getArticles')->name('articles-by-category');
Route::get('keyword/article/{keywordName}', 'KeywordController@getArticles')->name('articles-by-keyword');
Route::get('search/articles/{type}/{search_query?}', 'ArticleController@search')->name('search-article');
Route::get('search/user-articles/{user_id}/{type}/{search_query?}','ArticleController@searchUserArticles')->name('search-user-article');

//Comment
Route::get('/get_comments/{id}/{type}','CommentController@getComments');
Route::post('/add_comment','CommentController@addComment');
Route::post('/delete_comment','CommentController@deleteComment');
Route::post('/update_comment','CommentController@updateComment');
//Category
Route::get('category/{categoryId}', 'CategoryController@show')->name('get-category');


Route::get('user/article_images/{id?}','ArticleController@getArticleImages')->name('get-article-images');


Route::get('travellerslist','UserController@travellers');

Route::get('travellers',function(){
    return view('traveller.list');
})->name('get-all-travellers');

Route::get('blogs',function(){
    return view('blogs.list');
})->name('get-all-blogs');

Route::get('traveller/profile/{id?}','UserController@profile')->name('user-profile');



Route::get('trip/travellerslist/{id}','TripController@travellers');


Route::group(['middleware' => 'customAuth'], function () {
    
    Route::get('traveller/edit-profile','UserController@edit')->name('user-profile-edit');
    Route::get('traveller/reset-password','UserController@edit')->name('reset-password');
    Route::post('traveller/update','UserController@update')->name('user-update');
    Route::post('traveller/change-password', 'UserController@changePassword')->name('change-password');

    //user 
    Route::post('user/user-profile-pic', 'UserController@uploadProPic')->name('upload_pro_pic');
    Route::post('user_article/user-article-pic', 'ArticleController@uploadImages')->name('upload_article_pic');
    Route::post('user/user-pic', 'UserController@uploadPic')->name('upload_pic');
    Route::post('user/del-pic', 'UserController@deletePic')->name('delete_pic');
    //Route::post('user/update-article-content', 'UserController@deletePic')->name('update-article-content');

    Route::post('user/article/update/{id}','ArticleController@update')->name('update-article');
    Route::get('user/article/addorremovecover/{id}','ArticleController@addOrRemoveCover')->name('add-romove-article-cover');
    Route::post('user/article/delete_images','ArticleController@deleteImages')->name('delete-article-images');
    Route::get('user/article/create','ArticleController@create')->name('create-article');
    Route::post('user/article', 'ArticleController@store')->name('store-article');
    Route::get('user/article/create/{id?}','ArticleController@create')->name('edit-article');

    //trip
    Route::get('trip/create/{id?}','TripController@create')->name('create-trip');
    Route::post('trip/update/{id}','TripController@update')->name('update-trip');
    Route::post('trip/activity/create','TripController@createActivity')->name('create-activity');
    Route::post('trip/activity/update/{id}','TripController@updateActivity')->name('update-activity');
    Route::post('trip/store','TripController@store')->name('store-trip');

    Route::get('/trip/{id}/{type}/del_pub','TripController@togleTrip');
    Route::get('/trip_activity/{id}/{type}/del_pub','TripController@togleActivity');

    Route::post('/asset/delete/{type}/{id}','ArticleController@deleteAsset');
});

Route::get('trip/{id?}','TripController@show')->name('show-trip');

Route::get('/test_comment','CommentController@test');

