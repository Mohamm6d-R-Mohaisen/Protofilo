
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;

    /* ------------------------------------- Auth Routes --------------------------------- */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('show-login');
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
   /* ------------------------------------- Admin Dashboard --------------------------------- */
   Route::group(['middleware' => [ 'admin', 'auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* ------------------------------------- Settings Routes --------------------------------- */
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', [SettingController::class , 'index'])->name('index');
        Route::post('update', [SettingController::class , 'update'])->name('update');
    });
    /* ------------------------------------- Settings Routes --------------------------------- */
      /* ------------------------------------- User Routes --------------------------------- */
      Route::resource('users', UserController::class);
      Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
          Route::get('data/datatables', [UserController::class, 'datatable'])->name('datatable');
          Route::post('activate/{id}', [UserController::class, 'activate'])->name('active');
          Route::post('bluck/delete', [UserController::class , 'bluckDestroy'])->name('bluck_delete');
      });
            /* ------------------------------------- User Routes --------------------------------- */

      /* ------------------------------------- Admin Routes --------------------------------- */
      Route::resource('admins', AdminController::class);
      Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
          Route::get('data/datatables', [AdminController::class, 'datatable'])->name('datatable');
          Route::post('activate/{id}', [AdminController::class, 'activate'])->name('active');
          Route::post('bluck/delete', [AdminController::class , 'bluckDestroy'])->name('bluck_delete');
      });

        /* ------------------------------------- Role Routes --------------------------------- */
        Route::resource('roles', RoleController::class);
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('data/datatables', [RoleController::class, 'datatable'])->name('datatable');
        });
        /* ------------------------------------- Role Routes --------------------------------- */
  /* ------------------------------------- contact Routes --------------------------------- */
  Route::resource('contacts', ContactController::class);
  Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
      Route::get('data/datatables', [ContactController::class , 'datatable'])->name('datatable');
      Route::post('reply/{contact}/reply', [ContactController::class, 'reply'])->name('reply');
  });
  /* ------------------------------------- contact Routes --------------------------------- */


  /* ------------------------------------- Slider Routes --------------------------------- */
  Route::resource('sliders', SliderController::class);
  Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], function () {
      Route::get('data/datatables', [SliderController::class, 'datatable'])->name('datatable');
  });
  /* ------------------------------------- Slider Routes --------------------------------- */
    /* ------------------------------------- about Routes --------------------------------- */
    Route::resource('abouts', AboutController::class);
    Route::group(['prefix' => 'abouts', 'as' => 'abouts.'], function () {
        Route::get('data/datatables', [AboutController::class , 'datatable'])->name('datatable');
    });
    /* ------------------------------------- about Routes --------------------------------- */
      /* ------------------------------------- about Routes --------------------------------- */
      Route::resource('categories', CategoryController::class);
      Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
          Route::get('data/datatables', [CategoryController::class , 'datatable'])->name('datatable');
      });
      /* ------------------------------------- about Routes --------------------------------- */
       /* ------------------------------------- about Routes --------------------------------- */
       Route::resource('projects', ProjectController::class);
       Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
           Route::get('data/datatables', [ProjectController::class , 'datatable'])->name('datatable');
       });
       /* ------------------------------------- about Routes --------------------------------- */
       /* ------------------------------------- Service Routes --------------------------------- */
       Route::resource('services', ServiceController::class);
       Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
           Route::get('data/datatables', [ServiceController::class , 'datatable'])->name('datatable');
       });
       /* ------------------------------------- Service Routes --------------------------------- */
       /* ------------------------------------- Skills Routes --------------------------------- */
       Route::resource('skills', SkillController::class);
       Route::group(['prefix' => 'skills', 'as' => 'skills.'], function () {
           Route::get('data/datatables', [SkillController::class , 'datatable'])->name('datatable');
       });
       /* ------------------------------------- Skills Routes --------------------------------- */
       /* ------------------------------------- Testimonial Routes --------------------------------- */
       Route::resource('testimonials', TestimonialController::class);
       Route::group(['prefix' => 'testimonials', 'as' => 'testimonials.'], function () {
           Route::get('data/datatables', [TestimonialController::class , 'datatable'])->name('datatable');
       });
       /* ------------------------------------- Testimonial Routes --------------------------------- */



   });
