<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('close/{ticket}', 'closeTicket')->name('close');
    Route::get('download/{ticket}', 'ticketDownload')->name('download');
});
// Route::get('/articles', 'ArticleController@all')->name('articles.all');

Route::controller('SiteController')->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');
    //knowledge base
    Route::get('/knowledge/{id?}', 'knowledge')->name('knowledge');
    Route::get('/search/articles', 'ArticleController@search')->name('search.articles');
    Route::get('/knowledge/article/{id}', 'SiteController@show')->name('show');


    //knowledge base

    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');

    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('blog', 'blog')->name('blog');
    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');

    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');
    Route::post('/subscribe', 'SiteController@subscribe')->name('subscribe');

    // Route::get('/products/{category?}/{id?}', 'products')->name('products');
    // Route::get('/articles/{category?}/{id?}', 'products')->name('articles');
    // Route::get('/articles/{category?}/{id?}', 'products')->name('articles');
    Route::get('/articles/{category?}/{id?}','products')->name('products');


    // Route::get('/articles', 'products')->name('articles.all');
    Route::get('/category-products/{slug?}/{id?}', 'categoryProducts')->name('category.products');
    Route::get('/product/details/{id}', 'productDetails')->name('product.details');
    


    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
});
