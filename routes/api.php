<?php

use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Notifications\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\User\CartController;

//User Register
Route::post('/register',[AuthController::class,'register']);

//User Login
Route::post('/login',[AuthController::class,'login']);

//UserList
Route::get('/usersList',[AuthController::class,'usersList']);

//Delete user
Route::delete('/deleteUser/{id}',[AuthController::class,'deleteUser']);

//Search user
Route::get('/searchUser/{key}',[AuthController::class,'searchUser']);

//User Service list
Route::get('/userServiceList',[ServiceController::class,'userServiceList']);

//Single service
Route::get('/singleService/{id}',[ServiceController::class,'singleService']);

//Search service
Route::get('/searchService/{key}',[ServiceController::class,'searchService']);

//Store bookings
Route::post('/storeBooking',[OrderController::class,'storeBooking']);

// Get list of all Bookings
Route::get('/bookinglist',[OrderController::class,'bookingList']);

//Search Booking
Route::get('/searchBooking/{key}',[OrderController::class,'searchBooking']);



// Address store to table
Route::post('/storeAddress',[AddressController::class,'storeAddress']);

//Latest Order id
Route::post('/getLatestOrderId', [AddressController::class, 'getLatestOrderId']);

//Get the address by order
Route::get('/address-by-order/{orderId}', [AddressController::class, 'getAddressByOrderId']);

// Add to cart
Route::post('/addToCart',[CartController::class,'addToCart']);

// Get cart list
Route::get('/getCartList',[CartController::class,'cartList']);

// Delete cart
Route::delete('/deleteCart/{id}',[CartController::class,'deleteCart']);

// Handle Status of booking
Route::post('/booking/{id}/status', [OrderController::class, 'updateBookingStatus']);

//Notification
Route::post('/notifications', [NotificationController::class, 'updateBookingStatus']);

//Fetch Notification to the user
Route::get('/notifications/{userId}', [NotificationController::class, 'getUserNotifications']);

//Chat
Route::post('/messages', [ChatController::class, 'message']);


//Admin register
Route::post('/adminregister',[AdminController::class,'adminregister']);

//Admin login
Route::post('/adminlogin',[AdminController::class,'adminlogin']);

//Add a new service
Route::post('/addService',[ServiceController::class,'addService']);

//List the service in admin panel
Route::get('/list',[ServiceController::class,'list']);

//Delete service
Route::delete('/delete/{id}',[ServiceController::class,'delete']);

//Update service
Route::put('/update/{id}', [ServiceController::class, 'updateServiceList']);



//super admin register
Route::post('/superadminregister',[SuperAdminController::class,'superadminregister']);

//super admin login
Route::post('/superadminlogin',[SuperAdminController::class,'superadminlogin']);






