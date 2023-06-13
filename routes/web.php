<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
//Admin all route
Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/edit/profile', [AdminController::class, 'editProfile'])->name('edit.profile');
    Route::post('/store/profile', [AdminController::class, 'storeProfile'])->name('store.profile');
    Route::get('/change/password', [AdminController::class, 'changePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('update.password');

});

//home slide rout
Route::middleware('auth')->group(function () {
    Route::get('/home/slide', [HomeSliderController::class, 'homeSlider'])->name('home.slide');
    Route::post('/update/slide',[HomeSliderController::class,'updateSlide'])->name('update.slider');


});

//about Page all route
Route::middleware('auth')->group(function () {
    Route::get('/about/page', [AboutController::class, 'aboutPage'])->name('about.page');
    Route::post('/about/update', [AboutController::class, 'aboutUpdate'])->name('update.about');
    Route::get('/about', [AboutController::class, 'homeAbout'])->name('home.about');
    Route::get('/about/multi/image', [AboutController::class, 'aboutMultiImage'])->name('about.multi.image');
    Route::post('/store/multi', [AboutController::class, 'storeMultiImage'])->name('store.multi.image');
    Route::get('/all/multi/image', [AboutController::class, 'allMultiImage'])->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', [AboutController::class, 'editMultiImage'])->name('edit.multi.image');
    Route::post('/update/multi/image', [AboutController::class, 'updateMultiImage'])->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', [AboutController::class, 'deleteMultiImage'])->name('delete.multi.image');




});


require __DIR__.'/auth.php';
