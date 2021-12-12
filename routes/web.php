<?php


use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Site\MediaController;
use App\Http\Controllers\Site\HomeController;
use App\Models\Plugin;
use Illuminate\Support\Facades\Route;

Route::get('/install', 'InstallController@index');
Route::post('/install', 'InstallController@install');
Route::get('/install/migrate', 'InstallController@migrate');

Route::get('admin', [LoginController::class, 'index'])->name('admin.login');
Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login.index');
Route::get(
    'admin/auth',
    function () {
        return redirect(route('admin.login'));
    }
);
Route::post('admin/auth', [LoginController::class, 'auth'])->name('admin.auth');

Route::namespace('Site')->group(
    function () {
        // check show plugin
        try {
            $countPlugin = Plugin::query()->where('status', 1)->where('is_home_route', 1)->count();
            if ($countPlugin == 0) {
                Route::get('/', [HomeController::class, 'index'])->name('home');
            }
        } catch (Exception $exception) {
        }

        // user
        Route::get('users/activemail', 'UserController@activeMail');

        // member
        Route::middleware(['config.member.login'])->group(
            function () {
                Route::get('member/dashboard', 'MemberController@dashboard');
                Route::get('member/activemail', 'MemberController@activeMail');
                Route::get('member/login', 'MemberController@login');
                Route::post('member/login', 'MemberController@handleLogin');
                Route::get('member/register', 'MemberController@register');
                Route::post('member/register', 'MemberController@handleRegister');
                Route::get('member/forgot', 'MemberController@forgot');
                Route::post('member/forgot', 'MemberController@handleForgot');
                Route::get('member/login-social/{provider}', 'MemberController@loginSocial');
                Route::get('member/callback/{provider}', 'MemberController@callbackSocial');

                Route::middleware(['auth.web'])->group(
                    function () {
                        // member
                        Route::get('member', 'MemberController@index');
                        Route::get('member/update-profile', 'MemberController@updateProfile');
                        Route::post('member/update-profile', 'MemberController@handleUpdateProfile');
                        Route::get('member/change-password', 'MemberController@changePassword');
                        Route::post('member/change-password', 'MemberController@handleChangePassword');
                        Route::get('member/my-bookmark-posts', 'MemberController@myBookmarkPost');

                        Route::get('member/notifications', 'MemberController@notifications');
                        Route::get('member/notification/show/{id}', 'MemberController@notificationDetail');
                        Route::put('member/notification/{id}/make-read', 'MemberController@makeReadNotification');
                        Route::get('member/logout', 'MemberController@logout');

                        // media
                        Route::post('api/media/upload', [MediaController::class, 'upload']);
                        Route::delete('api/media/{id}', [MediaController::class, 'destroy']);
                    }
                );
            }
        );

        // page
        Route::get('/' . config('constant.URL_PREFIX_PAGE') . '/{slugCategory}', 'PageController@view');
        Route::get('404.html', 'PageController@notfound');
        Route::get('maintenance', 'PageController@maintenance');
        Route::get('resume', 'PageController@resume');


        // tag
        Route::get('/' . config('constant.URL_PREFIX_TAG') . '/{slug}', 'TagController@index');
        Route::get('search', 'SearchController@index');

        // sitemap
        Route::get('sitemap.xml', 'SitemapController@index');

        // contact
        Route::post('contact/register-email', 'ContactController@registerEmail');
        Route::post('contact', 'ContactController@addContact');
        Route::post('contact_submit', 'ContactController@addContactAjax');

        // comment
        Route::post('comment/create', 'CommentController@addComment');

        // banner
        Route::get('banner/tracking/{slug}', 'AdsController@tracking');  

        // post
        Route::get('{slugPost}.html', 'PostController@show');
        Route::get('/{slugCategory}/{slugPost}.html', 'PostController@view');
        Route::get('/' . config('constant.URL_PREFIX_POST') . '/{slugPost}.html', 'PostController@view');
        Route::get('/{slugCategory}', 'PostController@index');
        Route::get('/' . config('constant.URL_PREFIX_POST'), 'PostController@index');
        Route::post('/' . config('constant.URL_PREFIX_POST') . '/bookmark', 'PostController@postBookmark');
        
    }
);