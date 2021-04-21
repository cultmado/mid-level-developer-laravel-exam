<?php

/* dashboard routes */
Route::get('/', function () {
    return redirect('/admin/dashboard');
});

/* dashboard */
Route::get('/dashboard', [
    'uses' => '\App\Http\Controllers\AdminDashboardController@index',
    'as' => 'admin.dashboard',
]);
/* dashboard */

/* users */
Route::get('/users/draw',
    ['as' => 'admin.users.draw',
        'uses' => '\App\Http\Controllers\UserController@draw']
);

Route::resource('/users', 'UserController', [
    'as' => 'admin'
]);

Route::delete('/users/{id}/delete',
    ['as' => 'admin.users.delete',
        'uses' => '\App\Http\Controllers\UserController@destroy']
);
/* users */

/* roles */
Route::resource('/roles', 'RoleController', [
    'as' => 'admin'
]);

Route::delete('/roles/{id}/delete',
    ['as' => 'admin.roles.delete',
        'uses' => '\App\Http\Controllers\RoleController@destroy']
);
/* roles */

/* permissions */
Route::resource('/permissions', 'PermissionController', [
    'as' => 'admin'
]);

Route::delete('/permissions/{id}/delete',
    ['as' => 'admin.permissions.delete',
        'uses' => '\App\Http\Controllers\PermissionController@destroy']
);
/* permissions */

/* permission groups */
Route::resource('/permission_groups', 'PermissionGroupController', [
    'as' => 'admin'
]);

Route::delete('/permission_groups/{id}/delete',
    ['as' => 'admin.permission_groups.delete',
        'uses' => '\App\Http\Controllers\PermissionGroupController@destroy']
);
/* permission groups */

/* system settings */
Route::resource('/system_settings', 'SystemSettingController', [
    'as' => 'admin',
]);

Route::delete('/system_settings/{id}/delete',
    ['as' => 'admin.system_settings.delete',
        'uses' => '\App\Http\Controllers\SystemSettingController@destroy']
);
/* system settings */

/* posts */
Route::resource('/posts', 'PostController', [
    'as' => 'admin'
]);

Route::delete('/posts/{id}/delete',
    ['as' => 'admin.posts.delete',
        'uses' => '\App\Http\Controllers\PostController@destroy']
);
/* posts */

/* pages */
Route::resource('/pages', 'PageController', [
    'as' => 'admin'
]);

Route::delete('/pages/{id}/delete',
    ['as' => 'admin.pages.delete',
        'uses' => '\App\Http\Controllers\PageController@destroy']
);
/* pages */

/* ckeditor image upload */
Route::post('/ckeditor_image_upload',
    ['as' => 'admin.ckeditor_image_upload',
        'uses' => '\App\Http\Controllers\PageController@ckEditorImageUpload']
);
/* ckeditor image upload */

Route::post('/upload', '\App\Http\Controllers\PageController@upload')->name('admin.upload');

/* home_slides */
Route::resource('/home_slides', 'HomeSlideController', [
    'as' => 'admin'
]);

Route::delete('/home_slides/{id}/delete',
    ['as' => 'admin.home_slides.delete',
        'uses' => '\App\Http\Controllers\HomeSlideController@destroy']
);
/* home_slides */

/* contacts */
Route::resource('/contacts', 'ContactController', [
    'as' => 'admin'
]);

Route::delete('/contacts/{id}/delete',
    ['as' => 'admin.contacts.delete',
        'uses' => '\App\Http\Controllers\ContactController@destroy']
);
/* contacts */

/* presses */


/*Route::resource('/faqs', 'FAQController', [
    'as' => 'admin'
]);

*/

// Product
Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@index')->name('admin.product.index');
    Route::get('new', 'ProductController@create')->name('admin.product.create');
    Route::get('{id}/edit', 'ProductController@edit')->name('admin.product.edit');
    Route::get('{id}', 'ProductController@show')->name('admin.product.show');

    Route::post('', 'ProductController@store')->name('admin.product.store');
    Route::post('{id}/update', 'ProductController@update')->name('admin.product.update');
    Route::delete('', 'ProductController@delete')->name('admin.product.delete');
});

Route::prefix('product-categories')->group(function () {
    Route::get('', 'ProductCategoryController@index')->name('admin.product-categories.index');
    Route::get('new', 'ProductCategoryController@create')->name('admin.product-category.create');
    Route::get('{id}/edit', 'ProductCategoryController@edit')->name('admin.product-category.edit');
    Route::get('{id}', 'ProductCategoryController@show')->name('admin.product-category.show');

    Route::post('', 'ProductCategoryController@store')->name('admin.product-category.store');
    Route::post('{id}/update', 'ProductCategoryController@update')->name('admin.product-category.update');
    Route::delete('', 'ProductCategoryController@delete')->name('admin.product-category.delete');
});
