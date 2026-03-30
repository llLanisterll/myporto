<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo/darkmode', function () {
    return view('demo.darkmode');
});

Route::get('/demo/responsive', function () {
    return view('demo.responsive');
});

Route::get('/demo/form-validation', function () {
    return view('demo.form-validation');
});

Route::get('/demo/api-fetch', function () {
    return view('demo.api-fetch');
});

Route::get('/demo/drag-drop', function () {
    return view('demo.drag-drop');
});

Route::get('/demo/animations', function () {
    return view('demo.animations');
});

Route::get('/demo/charts', function () {
    return view('demo.charts');
});

Route::get('/demo/chat', function () {
    return view('demo.chat');
});

Route::get('/demo/image-filters', function () {
    return view('demo.image-filters');
});

Route::get('/demo/cart', function () {
    return view('demo.cart');
});

Route::get('/demo/multistep-form', function () {
    return view('demo.multistep-form');
});

Route::get('/demo/skeleton', function () {
    return view('demo.skeleton');
});

// Template preview pages (used as iframe sources in hero showcase)
$templates = ['ecommerce', 'dashboard', 'blog', 'saas', 'portfolio', 'restaurant', 'admin', 'social', 'travel', 'music'];
foreach ($templates as $tpl) {
    Route::get("/templates/{$tpl}", function () use ($tpl) {
        return view("templates.{$tpl}");
    });
}
