<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'homepage']); // Public homepage route
Route::get('/services', [HomeController::class, 'services'])->name('services');


// Routes requiring authentication
Route::middleware('auth')->group(function () {

    // Admin Routes
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/post_page', [AdminController::class, 'post_page']);
    Route::get('/user_page', [AdminController::class, 'user_page']);
    Route::post('/add_post', [AdminController::class, 'add_post']);
    Route::get('/show_post', [AdminController::class, 'show_post']);
    Route::get('/delete_post/{id}', [AdminController::class, 'delete_post']);
    Route::get('/edit_post/{id}', [AdminController::class, 'edit_post']);
    Route::post('/update_post/{id}', [AdminController::class, 'update_post']);
    
    Route::get('/create_user', [AdminController::class, 'create_user']);

// Handle form submission for creating a user
    Route::post('/add_user', [AdminController::class, 'add_user']);
    Route::get('/show_user', [AdminController::class, 'show_user']);
    Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);
    Route::get('/edit_user/{id}', [AdminController::class, 'edit_user']);
    Route::post('/update_user/{id}', [AdminController::class, 'update_user']);

    Route::get('/tutorial_page', [AdminController::class, 'tutorial_page']);
    Route::get('/delete_tutorial/{id}', [AdminController::class, 'delete_tutorial']);
    
    // Post Details
    Route::get('/post_details/{id}', [HomeController::class, 'post_details']);
    
    // User Routes (My Posts)
    Route::get('/create_post', [HomeController::class, 'create_post']);
    Route::post('/add_post', [HomeController::class, 'add_post']);
    Route::get('/my_post', [HomeController::class, 'my_post']);
    Route::get('/delete_mypost/{id}', [HomeController::class, 'delete_mypost']);
    Route::get('/edit_mypost/{id}', [HomeController::class, 'edit_mypost']);
    Route::post('/update_mypost/{id}', [HomeController::class, 'update_mypost']);
    Route::get('/accept_post/{id}', [AdminController::class, 'accept_post']);
    Route::get('/reject_post/{id}', [AdminController::class, 'reject_post']);

    //
    Route::get('/create_tutorial', [HomeController::class, 'create_tutorial']);
    Route::post('/add_tutorial', [HomeController::class, 'add_tutorial']);

    Route::get('/my_tutorials', [HomeController::class, 'my_tutorials'])->name('my_tutorials');
    Route::get('/delete_tutorial/{id}', [HomeController::class, 'delete_tutorial']);
    Route::get('/tutors', [HomeController::class, 'tutors'])->name('tutors');
    Route::get('/tutorial_details/{id}', [HomeController::class, 'tutor_details'])->name('tutor_details');
    Route::get('/hire_tutor_form/{id}', [HomeController::class, 'hireTutorForm']);
    Route::post('/hire_tutor/{id}', [HomeController::class, 'hireTutor']);

    Route::get('/group', [HomeController::class, 'group'])->name('group');

    Route::get('/create_group', [HomeController::class, 'create_group']);  
    Route::post('/add_group', [HomeController::class, 'add_group']); 
    Route::get('/groups', [HomeController::class, 'showGroups'])->name('groups');

    // Route to join a group
// Route to show the group page where users can send messages
Route::get('/group/{group_id}', [HomeController::class, 'show_group'])->name('show_group');

// Route to join a group
Route::post('/join_group/{group_id}', [HomeController::class, 'join_group'])->name('join_group');
Route::get('/group/{group_id}', [HomeController::class, 'enter_group'])->name('show_group');

// Route for sending a message in a group
Route::post('/send_message/{group_id}', [HomeController::class, 'send_message'])->name('send_message');
Route::get('/group/{group_id}', [HomeController::class, 'enter_group'])->name('enter_group');



});

