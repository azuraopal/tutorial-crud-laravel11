<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\FProjectController;
use App\Http\Controllers\FSkillController;
use App\Http\Controllers\HomeController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SkillController;

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

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('about', AboutController::class);
    Route::resource('skill', SkillController::class);
    Route::resource('certificate', CertificateController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('contact', ContactController::class);
});

Route::get('certificate/{id}/thumbnail', [CertificateController::class, 'generateThumbnail'])->name('certificate.thumbnail');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', action: [HomeController::class, 'index'])->name('home.index');

require __DIR__ . '/auth.php';
