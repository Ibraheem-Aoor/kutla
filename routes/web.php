<?php
Route::get('404',function (){
    return view('errors.404');
})->name(404);

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class,'showAdminLoginForm'])->name('showAdminLoginForm');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class,'login'])->name('adminLogin');
/*  start link  new  front */
//Route::group(['prefix' => 'new'], function() {
    Route::get('/', 'Front\FrontController@new_index')->name('front.new_index');
    Route::get('aboutUs', 'Front\FrontController@new_aboutUs')->name('new.aboutUs');
    Route::get('/allNews', 'Front\FrontController@new_allNews')->name('new.allNews');
    Route::get('/category/{slug}', 'Front\FrontController@new_category_show')->name('new.new_category_show');
    Route::get('alboms/{albom}', 'Front\FrontController@new_show_photo')->name('new.alboms.images');
    Route::get('/post/{post}/{slug}', 'Front\FrontController@new_post_show')->name('new.news.page');
    Route::get('/category/{category}/{slug}', 'Front\FrontController@new_category_posts')->name('new.category.front');
    Route::get('posts/tags/{tag}/{slug}', 'Front\FrontController@new_tag')->name('post.new_tag');
    Route::get('/categories/post/{category}', 'Front\FrontController@newcategoryGetAllPost')->name('newcategoryGetAllPost');
    Route::get('/post/{post}', 'Front\FrontController@new_post_show_twitter')->name('new_post_show_twitter');
//});
/* end link  new  front */
Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);
/* start last front */

//Route::get('/', 'Front\FrontController@index')->name('front.index');
//Route::get('aboutUs', 'Front\FrontController@aboutUs')->name('aboutUs');
//Route::get('/allNews', 'Front\FrontController@allNews')->name('allNews');
//Route::get('/categories/{slug}', 'Front\FrontController@category_show')->name('category_show');
//Route::get('alboms/{albom}', 'Front\FrontController@show_photo')->name('alboms.images');
//Route::get('/post/{post}/{slug}', 'Front\FrontController@post_show')->name('news.page');
//Route::get('/category/{category}/{slug}', 'Front\FrontController@category_posts')->name('category.front');
//Route::get('posts/tags/{tag}/{slug}', 'Front\FrontController@tag')->name('post.tag');
//Route::get('/categories/post/{category}', 'Front\FrontController@categoryGetAllPost')->name('categoryGetAllPost');
//Route::get('/post/{post}', 'Front\FrontController@post_show_twitter')->name('post_show_twitter');
/* start last front */












Route::post('add_to_mail', 'Front\FrontController@add_to_mail')->name('add_to_mail');
Route::post('contactUs', 'Front\FrontController@contactUsStore')->name('contactUsStore');
Route::get('contactUs', 'Front\FrontController@contactUs')->name('contactUs');
Route::get('video/{video}', 'Front\FrontController@show_video')->name('show_video');




Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::get('/user_logs', 'DashboardController@user_logs')->name('user_logs.index');
        Route::get('/user_record', 'DashboardController@user_record')->name('user_record.index');
        Route::get('/user_logs/search', 'DashboardController@search_user_logs');
        Route::get('/user_record/search', 'DashboardController@search_user_record');

        Route::get('/user_logs/open_session', 'DashboardController@open_session');
        Route::get('/user_logs/close_session', 'DashboardController@close_session');

        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', 'CategoriesController@index')->name('categories.index');
            Route::post('/', 'CategoriesController@store')->name('categories.store');
            Route::get('/create', 'CategoriesController@create')->name('categories.create');
            Route::get('/search', 'CategoriesController@search')->name('categories.search');
            Route::delete('/{id}', 'CategoriesController@delete_category')->name('categories.delete');
            Route::put('/{id}', 'CategoriesController@update')->name('categories.update');
            Route::get('/{id}/edit', 'CategoriesController@edit')->name('categories.edit');

        });

        Route::group(['prefix' => 'writers'], function() {
            Route::get('/', 'WritersController@index')->name('writers.index');
            Route::post('/', 'WritersController@store')->name('writers.store');
            Route::get('/create', 'WritersController@create')->name('writers.create');
            Route::get('/search', 'WritersController@search')->name('writers.search');
            Route::delete('/{id}', 'WritersController@delete_writer')->name('writers.delete');
            Route::put('/{id}', 'WritersController@update')->name('writers.update');
            Route::get('/{id}/edit', 'WritersController@edit')->name('writers.edit');

        });
        Route::group(['prefix' => 'hotels'], function() {
            Route::get('/', 'HotelsController@index')->name('hotels.index');
            Route::post('/', 'HotelsController@store')->name('hotels.store');
            Route::get('/create', 'HotelsController@create')->name('hotels.create');
            Route::get('/search', 'HotelsController@search')->name('hotels.search');
            Route::delete('/{id}', 'HotelsController@delete_hotel')->name('writers.delete');
            Route::put('/{id}', 'HotelsController@update')->name('hotels.update');
            Route::get('/{id}/edit', 'HotelsController@edit')->name('hotels.edit');

        });

        Route::group(['prefix' => 'cases'], function() {
            Route::get('/', 'CasesController@index')->name('cases.index');
            Route::post('/', 'CasesController@store')->name('cases.store');
            Route::get('/create', 'CasesController@create')->name('cases.create');
            Route::get('/search', 'CasesController@search')->name('cases.search');
            Route::delete('/{id}', 'CasesController@delete_case')->name('cases.delete');
            Route::put('/{id}', 'CasesController@update')->name('cases.update');
            Route::get('/{id}/edit', 'CasesController@edit')->name('cases.edit');

        });
        Route::group(['prefix' => 'events'], function() {
            Route::get('/', 'EventsController@index')->name('events.index');
            Route::post('/', 'EventsController@store')->name('events.store');
            Route::get('/create', 'EventsController@create')->name('events.create');
            Route::get('/search', 'EventsController@search')->name('events.search');
            Route::get('/check_event', 'EventsController@check_event');
            Route::post('/saw_event', 'EventsController@saw_event');
            Route::post('/remind_later', 'EventsController@remind_later');
            Route::delete('/{id}', 'EventsController@delete_event')->name('events.delete');
            Route::put('/{id}', 'EventsController@update')->name('events.update');
            Route::get('/{id}/edit', 'EventsController@edit')->name('events.edit');

        });

        Route::group(['prefix' => 'posts'], function() {
            Route::get('/', 'PostsController@index')->name('posts.index');
            Route::post('/', 'PostsController@store')->name('posts.store');
            Route::get('/posts_position', 'PostsController@posts_position')->name('posts.posts_position');
            Route::get('/create', 'PostsController@create')->name('posts.create');
            Route::get('/search', 'PostsController@search')->name('posts.search');
            Route::post('/search', 'PostsController@search_post');
            Route::get('/people_news', 'PostsController@people_news')->name('posts.people_news');
            Route::get('/search_people_news', 'PostsController@search_people_news');
            Route::get('/search_postion', 'PostsController@search_postion')->name('posts.search_postion');
            Route::post('/new_orders', 'PostsController@new_orders');
            Route::get('get_post/{id}', 'PostsController@get_post');
            Route::post('unpublish_post/{id}', 'PostsController@unpublish_post');
            Route::post('publish_post/{id}', 'PostsController@publish_post');
            Route::get('get_reaction/{id}', 'PostsController@get_reaction');

            Route::get('/{tag}', 'PostsController@index')->name('posts.tags');
            Route::delete('/{id}', 'PostsController@delete_post')->name('posts.delete');
            Route::put('/{id}', 'PostsController@update')->name('posts.update');
            Route::get('/{id}/edit', 'PostsController@edit')->name('posts.edit');
            Route::get('/{id}/cases', 'PostsController@post_case')->name('posts.cases');
            Route::delete('{id}/delete_position', 'PostsController@delete_position')->name('posts.delete_position');

        });

        Route::group(['prefix' => 'albums'], function() {
            Route::get('/', 'AlbomController@index')->name('albums.index');
            Route::post('/', 'AlbomController@store')->name('alboms.store');
            Route::get('/getAlbomCat', 'AlbomController@getAlbomCat');
            Route::get('/search', 'AlbomController@search_album');
            Route::get('/create', 'AlbomController@create')->name('albums.create');

            Route::delete('/image/{id}', 'AlbomController@deletImage')->name('image.delete');
            Route::post('/addPhotoToAlbom/{albom_id}', 'AlbomController@add_photo');
            Route::post('/image/addcover/{id}', 'AlbomController@addcover');
            Route::get('/{id}/cases', 'AlbomController@album_case')->name('albums.cases');
            Route::get('/{id}', 'AlbomController@show')->name('albums.show');
            Route::put('/{id}', 'AlbomController@update')->name('albom.update');
            Route::delete('/{id}', 'AlbomController@delete');
            Route::get('/{id}/edit', 'AlbomController@edit')->name('albums.edit');
            Route::post('/saveImageForAlbom', 'AlbomController@saveImageForAlbom')->name('albums.saveImageForAlbom');



        });

        Route::group(['prefix' => 'videos'], function() {
            Route::get('/', 'VideoController@index')->name('videos.index');
            Route::post('/uploadVideoFile', 'VideoController@uploadVideoFile');
            Route::get('/getAlbomCat', 'VideoController@getAlbomCat');
            Route::post('/', 'VideoController@store')->name('videos.store');
            Route::get('/search', 'VideoController@search')->name('videos.search');
            Route::get('/create', 'VideoController@create')->name('videos.create');
            Route::get('/{id}/cases', 'VideoController@video_case')->name('videos.cases');
            Route::get('/{id}', 'VideoController@show')->name('videos.show');
            Route::get('/{id}/edit', 'VideoController@edit')->name('videos.edit');
            Route::delete('/{id}/deleteVideo', 'VideoController@deleteVideo')->name('videos.deleteVideo');
            Route::put('/{id}', 'VideoController@update');
            Route::delete('/{id}', 'VideoController@delete');


        });

        Route::group(['prefix' => 'live_videos'], function() {
            Route::get('/', 'LiveVideoController@index')->name('live_videos.index');
            Route::post('/uploadVideoFile', 'LiveVideoController@uploadVideoFile');
            Route::get('/getAlbomCat', 'LiveVideoController@getAlbomCat');
            Route::post('/', 'LiveVideoController@store')->name('live_videos.store');
            Route::get('/search', 'LiveVideoController@search')->name('live_videos.search');
            Route::get('/create', 'LiveVideoController@create')->name('live_videos.create');
            Route::get('/{id}', 'LiveVideoController@show')->name('live_videos.show');
            Route::get('/{id}/edit', 'LiveVideoController@edit')->name('live_videos.edit');
            Route::delete('/{id}/deleteVideo', 'LiveVideoController@deleteVideo')->name('live_videos.deleteVideo');
            Route::put('/{id}', 'LiveVideoController@update');
            Route::delete('/{id}', 'LiveVideoController@delete');


        });


        Route::group(['prefix' => 'files_library'], function() {
            Route::post('/get_images', 'FilesLibraryController@get_images');
            Route::post('/get_videos', 'FilesLibraryController@get_videos');
            Route::post('/get_archive_files', 'FilesLibraryController@get_archive_files');
            Route::post('/details', 'FilesLibraryController@details_files');
            Route::post('/upload_image', 'FilesLibraryController@upload_image');
            Route::post('/upload_files', 'FilesLibraryController@upload_files');
            Route::post('/details_archive', 'FilesLibraryController@details_archive');
            Route::delete('/{id}', 'FilesLibraryController@delete_file');
            Route::delete('/delete_file/{id}', 'FilesLibraryController@delete_archive');

            /*** This Code Add By Moman albelbesie ***/
            Route::post('/saveNameOfFile', 'FilesLibraryController@saveNameOfFile');

        });

        Route::group(['prefix' => 'tags'], function() {
            Route::get('/', 'TagsController@index')->name('tags.index');
            Route::get('/search', 'TagsController@search')->name('tags.search');
            Route::get('/get_tags', 'TagsController@get_tags');
            Route::delete('/{id}', 'TagsController@delete');

        });
        Route::group(['prefix' => 'contactus'], function() {
            Route::get('/', 'ContactusController@index')->name('contactus.index');
            Route::get('/search', 'ContactusController@search');
            Route::delete('/{id}', 'ContactusController@delete');
            Route::post('/replay', 'ContactusController@replay');
            Route::get('/is_read/{id}', 'ContactusController@is_read');

        });
        Route::group(['prefix' => 'setting'], function() {
            Route::get('/', 'DashboardController@edit_setting')->name('setting.index');
            Route::post('/update', 'DashboardController@update_setting');

        });

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@users')->name('users.index');
            Route::post('/', 'UsersController@add_user');
            Route::get('/search', 'UsersController@search_users')->name('users.search');
            Route::get('/create', 'UsersController@create_user')->name('users.create');
            Route::get('/roles', 'UsersController@roles')->name('users.roles');
            Route::post('/roles', 'UsersController@store_roles')->name('roles.store');
            Route::get('/roles/search', 'UsersController@search_roles')->name('users.search_roles');
            Route::post('/roles/privilege', 'UsersController@add_privilege');
            Route::get('/roles/privilege/{id}', 'UsersController@privilege_roles');
            Route::delete('/roles/{id}', 'UsersController@delete_roles')->name('roles.delete');
            Route::put('/roles/{id}', 'UsersController@update_role')->name('roles.update_role');
            Route::get('/privilege/{id}', 'UsersController@user_privilege')->name('user.privilege');
            Route::put('/{id}', 'UsersController@update_user');
            Route::delete('/{id}', 'UsersController@delete');
            Route::get('/{id}/edit', 'UsersController@edit_user')->name('user.edit');

        });

        Route::group(['prefix' => 'votes'], function() {
            Route::get('/', 'VotesController@index')->name('votes.index');
            Route::post('/', 'VotesController@store')->name('votes.store');
            Route::post('/details', 'VotesController@details');
            Route::get('/create', 'VotesController@create')->name('votes.create');
            Route::get('/search', 'VotesController@search')->name('votes.search');
            Route::delete('/{id}', 'VotesController@delete_vote')->name('votes.delete');
            Route::put('/{id}', 'VotesController@update')->name('votes.update');
            Route::get('/{id}/edit', 'VotesController@edit')->name('votes.edit');

        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', 'PagesController@index')->name('pages.index');
            Route::post('/', 'PagesController@store')->name('pages.store');
            Route::get('/create', 'PagesController@create')->name('pages.create');
            Route::get('/search', 'PagesController@search')->name('pages.search');
            Route::delete('/{id}', 'PagesController@delete_page')->name('pages.delete');
            Route::put('/{id}', 'PagesController@update')->name('pages.update');
            Route::get('/{id}/edit', 'PagesController@edit')->name('pages.edit');

        });

        Route::group(['prefix' => 'urgents'], function() {
            Route::get('/', 'UrgentsController@index')->name('urgents.index');
            Route::post('/', 'UrgentsController@store')->name('urgents.store');
            Route::get('/create', 'UrgentsController@create')->name('urgents.create');
            Route::get('/search', 'UrgentsController@search')->name('urgents.search');
            Route::delete('/{id}', 'UrgentsController@delete_page')->name('urgents.delete');
            Route::put('/{id}', 'UrgentsController@update')->name('urgents.update');
            Route::get('/{id}/edit', 'UrgentsController@edit')->name('urgents.edit');

        });

        Route::group(['prefix' => 'advs'], function() {
            Route::get('/', 'AdvsController@index')->name('advs.index');
            Route::post('/', 'AdvsController@store')->name('advs.store');
            Route::get('/create', 'AdvsController@create')->name('advs.create');
            Route::get('/search', 'AdvsController@search')->name('advs.search');
            Route::get('/setting', 'AdvsController@setting')->name('advs.setting');
            Route::post('/setting', 'AdvsController@storeSetting');
            Route::delete('/{id}', 'AdvsController@delete_page')->name('advs.delete');
            Route::post('/{id}', 'AdvsController@update')->name('advs.update');
            Route::get('/{id}/edit', 'AdvsController@edit')->name('advs.edit');

        });
        Route::group(['prefix' => 'reports'], function() {
            Route::get('/', 'ReportsController@index')->name('reports.index');
            Route::post('/', 'ReportsController@store')->name('reports.store');
            Route::get('/create', 'ReportsController@create')->name('reports.create');
            Route::get('/search', 'ReportsController@search')->name('reports.search');
            Route::delete('/{id}', 'ReportsController@delete_reports')->name('reports.delete');

        });

        Route::group(['prefix' => 'mail_list'], function() {
            Route::get('/', 'MailListController@index')->name('mail_list.index');
            Route::get('/send', 'MailListController@send_mail')->name('mail_list.send');
            Route::get('/mail_sent', 'MailListController@mail_sent')->name('mail_list.mail_sent');
            Route::post('/send', 'MailListController@post_send_mail');
            Route::get('/search', 'MailListController@search');
            Route::get('/search_mail_sent', 'MailListController@search_mail_sent');
            Route::get('/search_posts', 'MailListController@search_posts');
            Route::delete('/{id}', 'MailListController@delete');

        });
        Route::get('link/search', 'LinkController@search');
        Route::resource('link','LinkController');
        Route::resource('banner','BannerController');
        Route::get('releas/search', 'ReleasController@search');
        Route::resource('releas','ReleasController');
//        Route::resource('remember','RememberController');

        Route::group(['prefix' => 'remember'], function() {
            Route::get('/', 'RememberController@index')->name('remember.index');
            Route::post('/', 'RememberController@store')->name('remember.store');
            Route::get('/posts_position', 'RememberController@posts_position')->name('remember.posts_position');
            Route::get('/create', 'RememberController@create')->name('remember.create');
            Route::get('/search', 'RememberController@search')->name('remember.search');
            Route::post('/search', 'RememberController@search_post');
            Route::get('/people_news', 'RememberController@people_news')->name('remember.people_news');
            Route::get('/search_people_news', 'RememberController@search_people_news');
            Route::get('/search_postion', 'RememberController@search_postion')->name('remember.search_postion');
            Route::post('/new_orders', 'RememberController@new_orders');
            Route::get('get_post/{id}', 'RememberController@get_post');
            Route::post('unpublish_post/{id}', 'RememberController@unpublish_post');
            Route::post('publish_post/{id}', 'RememberController@publish_post');
            Route::get('get_reaction/{id}', 'RememberController@get_reaction');

            Route::get('/{tag}', 'RememberController@index')->name('remember.tags');
            Route::delete('/{id}', 'RememberController@delete_post')->name('remember.delete');
            Route::put('/{id}', 'RememberController@update')->name('remember.update');
            Route::get('/{id}/edit', 'RememberController@edit')->name('remember.edit');
            Route::get('/{id}/cases', 'RememberController@post_case')->name('remember.cases');
            Route::delete('{id}/delete_position', 'RememberController@delete_position')->name('remember.delete_position');

        });


    });
});
Route::get('/route-cache', function() {
    \Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    \Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function() {
    \Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    \Artisan::call('view:clear');
    return 'View cache cleared';
});

Route::get('/test_nn', function (){
    $post = \App\Models\MainPost::latest()->first();
    event( new \App\Events\PostPublish($post));
});
