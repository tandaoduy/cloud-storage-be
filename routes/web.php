<?php

use Illuminate\Support\Facades\Route;

// Redirect password reset links to frontend reset page
Route::get('/password/reset/{token}', function ($token) {
    $frontend = rtrim(env('FRONTEND_URL', 'http://localhost:3000'), '/');
    $email = request()->query('email');
    $url = $frontend . '/reset-password?token=' . urlencode($token);
    if ($email) {
        $url .= '&email=' . urlencode($email);
    }
    return redirect()->away($url);
})->name('password.reset');

Route::get('/docs', function () {
    // Nếu bạn muốn có UI luôn:
    return view('l5-swagger::index');

    // Hoặc nếu chỉ cần cho nó có route, không cần UI:
    // return response()->json(['message' => 'API docs UI is disabled on this environment.']);
})->name('l5-swagger.default.docs');    