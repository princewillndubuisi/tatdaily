<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BlogController::class, 'welcome']);

// Career Routes
Route::get('career', [BlogController::class, 'career'])->name('career');
Route::get('career{career}', [BlogController::class, 'show_career'])->name('career.show');
Route::get('career{career}/link', [BlogController::class, 'link_career'])->name('career.link');
Route::get('career/apply', [BlogController::class, 'apply_career'])->middleware('auth')->name('career.apply');
Route::post('career/apply/store', [BlogController::class, 'save_application'])->name('career.save');

// User Routes
Route::get('read_post/{id}', [BlogController::class, 'read_post'])->name('read.post');
Route::get('category_post/{id}', [BlogController::class, 'category_post'])->name('category.post');
Route::get('home', [BlogController::class, 'home'])->middleware('auth')->name('home');
Route::get('create_post', [BlogController::class, 'create_post'])->middleware('auth')->name('create.post');
Route::post('/upload_user_image', [AdminController::class, 'upload_image'])->name('upload.user.image');
Route::post('user_post', [BlogController::class, 'user_post'])->middleware('auth')->name('user.post');
Route::get('profiles', [BlogController::class, 'profiles'])->middleware('auth')->name('profiles');


Route::get('user_post_del/{id}', [BlogController::class, 'user_post_del'])->middleware('auth')->name('user_post.del');
Route::get('user_post_edit/{id}', [BlogController::class, 'user_post_edit'])->middleware('auth')->name('user_post.edit');
Route::post('user_post_update/{id}', [BlogController::class, 'user_post_update'])->middleware('auth')->name('user_post.update');
Route::post('update_picture', [BlogController::class, 'update_picture'])->middleware('auth')->name('update.picture');


// Route::post('edit_user/{id}', [BlogController::class, 'edit_user'])->middleware('auth')->name('edit.user');
// End User Routes



// Admin Routes
Route::middleware(['auth', Admin::class])->group(function(){

    Route::get('dashboard_page', [AdminController::class, 'dashboard_page'])->name('dashboard.page');

    // Post routes
    Route::get('post_page', [AdminController::class, 'post_page'])->name('post.page');
    Route::post('add_post', [AdminController::class, 'add_post'])->name('add.post');
    Route::post('/upload_image', [AdminController::class, 'upload_image'])->name('upload.image');
    Route::get('show_post', [AdminController::class, 'show_post'])->name('show.post');
    Route::get('delete_post/{id}', [AdminController::class, 'delete_post'])->name('delete.post');
    Route::get('edit_page/{id}', [AdminController::class, 'edit_page'])->name('edit.page');
    Route::post('update_post/{id}', [AdminController::class, 'update_post'])->name('update.post');
    Route::get('accept_post/{id}', [AdminController::class, 'accept_post'])->name('accept.post');
    Route::get('reject_post/{id}', [AdminController::class, 'reject_post'])->name('reject.post');
    // End post routes

    // Category routes
    Route::get('show_category', [AdminController::class, 'show_category'])->name('show.category');
    Route::get('category_page', [AdminController::class, 'category_page'])->name('category.page');
    Route::post('add_category', [AdminController::class, 'add_category'])->name('add.category');
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->name('delete.category');
    Route::get('edit_category_page/{id}', [AdminController::class, 'edit_category_page'])->name('edit.category_page');
    Route::post('update_category/{id}', [AdminController::class, 'update_category'])->name('update.category');
    // End category routes

    // Career routes
    Route::get('show_career', [AdminController::class, 'show_career'])->name('show.career');
    Route::get('add_career_page', [AdminController::class, 'add_career_page'])->name('career.add');
    Route::post('career_store', [AdminController::class, 'store_career'])->name('career.store');
    Route::get('edit_career/{id}', [AdminController::class, 'edit_career'])->name('career.edit');
    Route::put('update_career', [AdminController::class, 'update_career'])->name('career.update');
    Route::get('delete_career/{id}', [AdminController::class, 'delete_career'])->name('career.delete');
    Route::get('applied_career', [AdminController::class, 'applied_career'])->name('career.applied');
    Route::get('/admin/download-resume/{id}', [AdminController::class, 'downloadResume'])->name('admin.download.resume');
    Route::get('/admin/download-files/{id}', [AdminController::class, 'downloadfiles'])->name('admin.download.files');
    Route::get('/admin/delete-resume/{id}', [AdminController::class, 'delete_applied_career'])->name('admin.delete.resume');


    // End career routes
});
// End Admin Routes

// Advert Routes
Route::middleware(['auth', Admin::class])->group(function(){
    Route::get('show_advert', [AdvertController::class, 'show_advert'])->name('show.advert');
    Route::get('add_advert', [AdvertController::class, 'add_advert'])->name('add.advert');
    Route::post('store_advert', [AdvertController::class, 'store_advert'])->name('advert.store');
    Route::get('edit_advert/{id}', [AdvertController::class, 'edit_advert'])->name('advert.edit');
    Route::put('update_advert/{id}', [AdvertController::class, 'update_advert'])->name('advert.update');
    Route::get('delete_advert/{id}', [AdvertController::class, 'delete_advert'])->name('advert.delete');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// back button on login pages
// Route::get('/back', function () {
//     return view('');
// });





require __DIR__.'/auth.php';
