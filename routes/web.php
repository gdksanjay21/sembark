<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    // Super admin routes start here
    Route::get('/dashboard', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'index'])->name('dashboard')->middleware([\App\Http\Middleware\SuperAdminMiddleware::class]);
    
    Route::get('/invite', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'invite'])->name('invite')->middleware([\App\Http\Middleware\SuperAdminMiddleware::class]);
    Route::post('/create', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'storeCompanyWithAdmin'])->name('create')->middleware([\App\Http\Middleware\SuperAdminMiddleware::class]);
    Route::get('/clients', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'clients'])->name('clients')->middleware([\App\Http\Middleware\SuperAdminMiddleware::class]);
    Route::get('/geturls', [\App\Http\Controllers\SuperAdmin\SuperAdminController::class, 'getAllUrls'])->name('geturls')->middleware([\App\Http\Middleware\SuperAdminMiddleware::class]);
    
    // Super admin routes ends here
    
    // Admin routes start here
    Route::get('/adashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('adashboard')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    
    Route::get('/minvite', [\App\Http\Controllers\Admin\AdminController::class, 'memberInvite'])->name('minvite')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    Route::post('/mcreate', [\App\Http\Controllers\Admin\AdminController::class, 'storeMember'])->name('mcreate')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    Route::get('/members', [\App\Http\Controllers\Admin\AdminController::class, 'members'])->name('members')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    
    
    Route::get('/genrateurl', [\App\Http\Controllers\Admin\AdminController::class, 'generateUrls'])->name('genrateurl')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    Route::post('/stroreurl', [\App\Http\Controllers\Admin\AdminController::class, 'storeUrl'])->name('stroreurl')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    Route::get('/genurls', [\App\Http\Controllers\Admin\AdminController::class, 'getUrls'])->name('genurls')->middleware([\App\Http\Middleware\AdminMiddleware::class]);
    
    // Admin routes ends here
    
    // Member routes start here
    Route::get('/mdashboard', [\App\Http\Controllers\Member\MemberController::class, 'index'])->name('mdashboard')->middleware([\App\Http\Middleware\MemberMiddleware::class]);
        
    Route::get('/mgenrateurl', [\App\Http\Controllers\Member\MemberController::class, 'generateUrls'])->name('mgenrateurl')->middleware([\App\Http\Middleware\MemberMiddleware::class]);
    Route::post('/mstroreurl', [\App\Http\Controllers\Member\MemberController::class, 'storeUrl'])->name('mstroreurl')->middleware([\App\Http\Middleware\MemberMiddleware::class]);
    Route::get('/mgenurls', [\App\Http\Controllers\Member\MemberController::class, 'getUrls'])->name('mgenurls')->middleware([\App\Http\Middleware\MemberMiddleware::class]);
    
    // Member routes ends here
    Route::get('/shurl/{name}', [\App\Http\Controllers\UrlRedirectController::class, 'getOriginalUrl']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
