<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\FilterDetailsController;

use App\Http\Controllers\FiltersController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LadybugsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\TargetsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MainDashboardController;

use Inertia\Inertia;

Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/projects_index');
    })->name('dashboard');

    Route::controller(DashboardController::class)->group(function () {
        // Route::get('dashboard/', 'index')->name('dashboard');
        Route::get('dashboard/edit', 'edit');
        Route::get('dashboard/update', 'update');
        Route::get('dashboard/store', 'store');
        Route::get('dashboard/destroy', 'destroy');
        Route::get('dashboard/create', 'create');
        Route::get('dashboard/show', 'show');
    });


    Route::controller(Users::class)->group(function () {
        Route::get('user/index', 'index');
        Route::get('user/edit', 'edit');
        Route::get('user/update', 'update');
        Route::get('user/store', 'store');
        Route::get('user/destroy', 'destroy');
        Route::get('user/create', 'create');
        Route::get('user/show', 'show');
    });

    Route::controller(FilterDetailsController::class)->group(function () {
        Route::get('filterDetails/index', 'index');
        Route::get('filterDetails/edit', 'edit');
        Route::get('filterDetails/update', 'update');
        Route::get('filterDetails/store', 'store');
        Route::get('filterDetails/destroy', 'destroy');
        Route::get('filterDetails/create', 'create');
        Route::get('filterDetails/show', 'show');
    });

Route::controller(ProjectsController::class)->group(function () {
    Route::get('projects_index', 'index')->name('projects_index');
    Route::get('projects/edit', 'edit');
    Route::post('project_update', 'update');
    Route::post('project_store', 'store');
    Route::delete('project_delete', 'destroy');
    Route::get('projects/create', 'create');
    Route::get('projects/show', 'show');
    Route::get('searchProject', 'searchProject')->name('searchProject');
    
});

    Route::controller(FiltersController::class)->group(function () {
        Route::get('filters/index', 'index');
        Route::get('filters/edit', 'edit');
        Route::get('filters/update', 'update');
        Route::post('filters/store', 'store');
        Route::get('filters/destroy', 'destroy');
        Route::get('filters/create', 'create');
        Route::get('filters/show', 'show');
    });

    Route::controller(ItemsController::class)->group(function () {
        Route::get('items/index', 'index');
        Route::get('items/edit', 'edit');
        Route::get('items/update', 'update');
        Route::get('items/store', 'store');
        Route::get('items/destroy', 'destroy');
        Route::get('items/create', 'create');
        Route::get('items/show', 'show');
    });


    Route::controller(LadybugsController::class)->group(function () {
        Route::get('ladybugs/index', 'index');
        Route::get('ladybugs/edit', 'edit');
        Route::get('ladybugs/update', 'update');
        Route::get('ladybugs/store', 'store');
        Route::get('ladybugs/destroy', 'destroy');
        Route::get('ladybugs/create', 'create');
        Route::get('ladybugs/show', 'show');
    });

Route::controller(TestsController::class)->group(function () {
    Route::get('tests_index', 'index')->name('tests_index');
    Route::get('tests_edit', 'edit');
    Route::post('tests_update', 'update');
    Route::post('tests_store', 'store')->name('tests_store');
    Route::delete('tests_delete', 'destroy');
    Route::get('tests_create', 'create');
    Route::post('tests_show', 'show');

  
    Route::get('test_trials', 'trials');
    Route::get('grid1', 'grid1');
    Route::post('updateRow', 'updateRow');
    Route::post('deleteCollection', 'deleteCollection');
    Route::post('updateTest', 'updateTest');
  
    // Route::get('make_quadrants', 'make_quadrants');
    
});


    Route::controller(RecordsController::class)->group(function () {
        Route::get('records_index', 'index');
        Route::get('records/edit', 'edit');
        Route::get('records/update', 'update');
        Route::get('records/store', 'store');
        Route::get('records/destroy', 'destroy');
        Route::get('records/create', 'create');
        Route::get('records/show', 'show');
    });


    Route::controller(TargetsController::class)->group(function () {
        Route::get('targets/index', 'index');
        Route::get('targets/edit', 'edit');
        Route::get('targets/update', 'update');

        Route::get('targets/destroy', 'destroy');
        Route::get('targets/create', 'create');
        Route::post('targets_store', 'store');
    });

 Route::controller(PreviewController::class)->group(function () {
    Route::get('preview_index', 'index');
    Route::get('practicePreview', 'PracticeView');
});
 Route::controller(EngineController::class)->group(function () {
    Route::get('engine', 'index');
   
});
Route::controller(MainDashboardController::class)->group(function () {
    Route::get('maindashboard', 'index')->name('maindashboard');
    Route::post('store_mainsettings', 'store')->name('store_mainsettings');
    Route::post('upload_images', 'uploadImage');
    Route::post('update_mainsettings', 'update');
    Route::get('PreviewTest', 'PreviewSettings')->name('PreviewTest');
    Route::post('recieve', 'RecieveJsonData');
    Route::get('tests', 'test');
    Route::get('testresult', 'testresult');
    Route::get('practice', 'practice');
    Route::get('export', 'export');
    Route::get('searchTest', 'searchTest')->name('searchTest');
    

});



});
