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

//Subscribe
Route::post('subscribe', 'UserController@subscribe')->name('subscribe');
Route::get('confirm-subscription/{userId}', 'UserController@confirmSubscribe')->name('confirm-subscribe');
Route::get('un-subscribe/{userId}', 'UserController@unSubscribe')->name('un-subscribe');

//feedback
Route::post('feedback', 'FeedbackController@store')->name('add-feedback');

//Article
Route::get('article', 'ArticleController@index')->name('articles');
Route::get('article/{articleId}/{articleHeading?}', 'ArticleController@show')->name('get-article');
Route::get('category/article/{categoryAlias}', 'CategoryController@getArticles')->name('articles-by-category');
Route::get('keyword/article/{keywordName}', 'KeywordController@getArticles')->name('articles-by-keyword');
Route::get('search/articles/{search_query?}', 'ArticleController@search')->name('search-article');
Route::get('search/user-articles/{user_id}/{search_query?}','ArticleController@searchUserArticles')->name('search-user-article');

//Comment
Route::post('comment/{articleId}', 'CommentController@store')->name('add-comment');
Route::get('comment/{commentId}/confirm', 'CommentController@confirmComment')->name('confirm-comment');

//Category
Route::get('category/{categoryId}', 'CategoryController@show')->name('get-category');

//Admin auth
Route::get('register', 'AuthController@showRegistrationForm')->name('register-form');
Route::post('register', 'UserController@store')->name('register');
Route::get('login', 'AuthController@showLoginForm')->name('login-form');
Route::post('admin/login', 'AuthController@login')->name('login');
Route::get('admin/logout', 'AuthController@logout')->name('logout');
Route::post('user/user-profile-pic', 'UserController@uploadProPic')->name('upload_pro_pic');
Route::post('user_article/user-article-pic', 'ArticleController@uploadImages')->name('upload_article_pic');
Route::post('user/user-pic', 'UserController@uploadPic')->name('upload_pic');
Route::post('user/del-pic', 'UserController@deletePic')->name('delete_pic');
Route::post('user/update-article-content', 'UserController@deletePic')->name('update-article-content');
Route::get('user/article/create','ArticleController@create')->name('create-article');
Route::post('user/article', 'ArticleController@store')->name('store-article');
Route::get('user/article/create/{id?}','ArticleController@create')->name('edit-article');
Route::get('user/article_images/{id?}','ArticleController@getArticleImages')->name('get-article-images');
Route::post('user/article/update/{id}','ArticleController@update')->name('update-article');
Route::get('user/article/addorremovecover/{id}','ArticleController@addOrRemoveCover')->name('add-romove-article-cover');
Route::post('user/article/delete_images','ArticleController@deleteImages')->name('delete-article-images');
Route::get('travellerslist','UserController@travellers');
Route::get('travellers',function(){
    return view('traveller.list');
})->name('get-all-travellers');
Route::get('blogs',function(){
    return view('blogs.list');
})->name('get-all-blogs');
Route::get('traveller/profile/{id?}','UserController@profile')->name('user-profile');
Route::get('traveller/edit-profile','UserController@edit')->name('user-profile-edit');


/*
|---------------------------------------------------------------------------------
| Route collection for OWNER, ADMIN and AUTHOR
|---------------------------------------------------------------------------------
| These route are specially for the author type of user so that
| they can manage their own article
|
*/
Route::group(['middleware' => ['customAuth', 'role:owner|admin|author|traveller']], function () {
    //user-profile
    
    //read article
    Route::get('traveller/article/{id}','ArticleController@readMyArticle')->name('read-my-article');

    // //profile
    // Route::get('admin/profile', 'UserController@profile')->name('user-profile');
    //dashboard
    Route::get('admin/dashboard', 'DashboardController@index')->name('admin-dashboard');
    //admin articles
    Route::get('admin/article', 'ArticleController@adminArticle')->name('admin-articles');
    Route::get(
        'admin/article/toggle-publish/{articleID}',
        'ArticleController@togglePublish'
    )->name('toggle-article-publish');
    // Route::get('admin/article/{articleId}/delete', 'ArticleController@destroy')->name('delete-article');
    
    // Route::get('admin/article/create', 'ArticleController@create')->name('create-article');
    // Route::post('admin/article', 'ArticleController@store')->name('store-article');
    // Route::get('admin/article/{articleId}/edit', 'ArticleController@edit')->name('edit-article');
    //Route::put('admin/article/{articleId}', 'ArticleController@update')->name('update-article');

    //Admin comments
    Route::get('admin/comment', 'CommentController@index')->name('comments');
    Route::get('admin/comment/{commentId}/delete', 'CommentController@destroy')->name('delete-comment');
    Route::get(
        'admin/comment/toggle-publish/{commentId}',
        'CommentController@togglePublish'
    )->name('toggle-comment-publish');
    Route::put('admin/comment/{commentId}', 'CommentController@update')->name('update-comment');

    //Admin feedback
    Route::get('admin/feedback', 'FeedbackController@index')->name('feedbacks');
    Route::get(
        'admin/feedback/toggle-resolved/{feedbackId}',
        'FeedbackController@toggleResolved'
    )->name('toggle-feedback-resolved');
    Route::get('admin/feedback/close/{feedbackId}', 'FeedbackController@close')->name('close-feedback');
});

/*
|---------------------------------------------------------------------------------
| Route collection for OWNER, ADMIN
|---------------------------------------------------------------------------------
| This area is only for Owner and Admin
| Owner and admin can manage other users
| and can add categories of article
| they have permission of other administrative task
|
*/
Route::group(['middleware' => ['customAuth', 'role:owner|admin']], function () {
    //admin category
    Route::get('admin/category', 'CategoryController@index')->name('categories');
    Route::get(
        'admin/category/toggle-active/{categoryId}',
        'CategoryController@toggleActive'
    )->name('toggle-category-active');
    Route::put('admin/category/{categoryId}', 'CategoryController@update')->name('update-category');
    Route::post('admin/category', 'CategoryController@store')->name('add-category');
    Route::get('admin/category/{categoryId}/delete', 'CategoryController@destroy')->name('delete-category');

    //Admin users
    Route::get('admin/user', 'UserController@index')->name('users');
    Route::get('admin/user/{userId}/show', 'UserController@show')->name('get-user');
    Route::get('admin/user/{userId}/delete', 'UserController@destroy')->name('delete-user');
    Route::put('admin/user/change-password', 'UserController@changePassword')->name('change-password');
    Route::get('admin/user/create', 'UserController@create')->name('create-user');
    Route::post('admin/user/create', 'UserController@store')->name('store-user');
    Route::get('admin/user/{userId}/edit', 'UserController@edit')->name('edit-user');
    Route::put('admin/user/{userId}/update', 'UserController@update')->name('update-user');
    Route::get('admin/user/toggle-active/{userId}', 'UserController@toggleActive')->name('toggle-user-active');

    //Admin keywords
    Route::post('admin/keyword', 'KeywordController@store')->name('add-keyword');
    Route::get('admin/keyword', 'KeywordController@index')->name('keywords');
    Route::get(
        'admin/keyword/toggle-active/{keywordId}',
        'KeywordController@toggleActive'
    )->name('toggle-keyword-active');
    Route::put('admin/keyword/{keywordId}', 'KeywordController@update')->name('update-keyword');
    Route::get('admin/keyword/{keywordId}/delete', 'KeywordController@destroy')->name('delete-keyword');
});

Route::group(['middleware' => ['customAuth', 'role:owner']], function () {
    //admin config
    Route::get('admin/config', 'ConfigController@index')->name('configs');
    Route::put('admin/config/{configId}', 'ConfigController@update')->name('update-config');
});

