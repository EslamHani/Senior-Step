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

Route::namespace('BackEnd')->prefix('admin')->middleware('auth','admin')->group(function(){
	Route::get('/home', 'HomeController@index')->name('admin.home');
	Route::resource('/users', 'UsersController')->except(['show']);
	Route::resource('/categories', 'CategoriesController')->except(['show']);
	Route::resource('/skills', 'SkillsController')->except(['show']);
	Route::resource('/tags', 'TagsController')->except(['show']);
	Route::resource('/pages', 'PagesController')->except(['show']);
	Route::resource('/courses', 'CoursesController')->except(['show']);
	Route::resource('/questions', 'QuestionsController')->except(['show']);
	Route::resource('/topics', 'TopicsController')->except(['show']);
	Route::resource('/videos', 'VideosController')->except(['show']);
	Route::resource('/files', 'FilesController')->except(['show']);
	Route::resource('/messages', 'MessagesController')->except(['show', 'update', 'create']);
	Route::post('/comments', 'VideosController@CommentStore')->name('comments.store');
	Route::delete('/comments/{id}', 'VideosController@CommentDestroy')->name('comments.destroy');
	Route::put('/comments/{id}', 'VideosController@updateComment')->name('comments.update');
	Route::post('/replay/comments', 'VideosController@replayComment')->name('commentsreplay');
	Route::delete('/replay/delete/{id}', 'VideosController@deleteReplayComment')->name('replay.destroy');
});




Route::namespace('FrontEnd')->group(function(){
	Route::resource('discussions', 'DiscussionController');
	Route::post('/discussion/like/{discussion}', 'DiscussionController@storeLike')->name('discussions.like');
	Route::get('/profile/{user}/archived', 'ProfileController@userCourses')->name('userCourses');
	Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('userProfileEdit');
	Route::get('/profile/{user}/notifications', 'UserNotificatiosController@show')->name('notifications');
	Route::post('/profile/{user}/follow', 'FollowsController@store')->name('FollowUser');
	Route::patch('/profile/{user}', 'ProfileController@update')->name('userProfileUpdate');
	Route::get('/profile/{user}', 'ProfileController@index')->name('userprofile');
	Route::post('/discussion/replies', 'ReplyDiscussionController@store')->name('reply.store');
	Route::post('/best/{discussionreply}', 'ReplyDiscussionController@BestReply')->name('bestReply');
	Route::delete('/discussion/replies/{reply}', 'ReplyDiscussionController@destroy')->name('reply.destroy');
	Route::post('/replies/like/{reply}', 'ReplyDiscussionController@storeLike')->name('replies.like');
	Route::post('/savedata', 'CommentsController@store');
	Route::get('/video/{id}/comments', 'CommentsController@index');
	Route::delete('/delete/comment/{id}', 'CommentsController@destroy');
	Route::get('/edit/{id}/comment', 'CommentsController@edit');
	Route::patch('/update/{id}/comment', 'CommentsController@update');
	Route::get('/edit/{id}/comment/reply', 'CommentsController@editReply');
	Route::patch('/update/{id}/comment/reply', 'CommentsController@updateReply');
	Route::delete('/delete/comment/reply/{id}', 'CommentsController@destroyReply');
	Route::get('/course/{course_name}', 'CoursesController@videosOfCourse')->name('course.videos');
	Route::get('/courses', 'CoursesController@courses')->name('courses');
	Route::get('/news', 'NewsController@news')->name('news');
	Route::get('/show', 'NewsController@ViewTopic')->name('topic');
	Route::get('/category/{category_name}', 'CategoriesController@coursesOfCategory')->name('category.courses');
	Route::get('/categories', 'CategoriesController@categories')->name('categories');
	Route::get('/skill', 'SkillsController@CoursesOfSkill')->name('frontend.skills');
	Route::get('/tag', 'TagsController@CoursesOfTags')->name('frontend.tags');
	Route::get('/files', 'FilesController@files')->name('show.files');
	Route::get('/view/pdf', 'FilesController@ViewFile')->name('viewpdf');
	Route::get('/download/pdf', 'FilesController@DownloadFile')->name('downloadpdf'); // To Download Pdf File
	Route::get('/contact-us', 'ContactController@viewContact')->name('viewContact');
	Route::post('/message/store', 'ContactController@storeMessage')->name('storeMessage');
	Route::get('/quiz/{course}', 'QuizesController@quickquiz')->name('quickquiz');
	Route::post('/check/exam', 'QuizesController@checkExam')->name('checkexam');
	Route::get('/archive/{course_id}', 'CoursesController@archivecourse')->name('archive');
	Route::get('/unarchive/{course_id}', 'CoursesController@unarchivecourse')->name('unarchive');
	Route::middleware('auth')->group(function() {
		Route::get('explorer', 'ExplorerController')->name('explorer');
		Route::resource('todos', 'TodoController');
		Route::patch('todos/completed/{id}', 'TodoController@completed')->name('todos.completed');
		Route::post('/videos/{videoId}/like', 'CoursesController@videoLike')->name('video.like');
	});
});



Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/', 'HomeController@home')->name('landing');
Route::get('/verification/{token}', 'Auth\RegisterController@verification')->name('email.verification');
Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebook')->name('falogin');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleFacebookCallback')->name('fbcallback');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle')->name('gologin');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('gocallback');

Route::get('/page/{slug}', 'HomeController@viewpage')->name('front.page');
Route::get('/aboutus', 'HomeController@aboutUs')->name('aboutus');












