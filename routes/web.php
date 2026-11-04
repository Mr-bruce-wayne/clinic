<?php

use App\Http\Controllers\{AppointmentController,AuthController,BillingController,ConsultationController,DashboardController,DoctorController,PatientController,SettingsController,StaffController};
use Illuminate\Support\Facades\Route;

Route::get('/login',[AuthController::class,'show'])->middleware('guest')->name('login');
Route::post('/login',[AuthController::class,'login'])->middleware('guest')->name('login.store');
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware(['auth'])->group(function(){
 Route::get('/',DashboardController::class)->name('dashboard');
 Route::resource('patients',PatientController::class)->except('destroy');
 Route::resource('appointments',AppointmentController::class)->only(['index','create','store','edit','update']);
 Route::post('appointments/{appointment}/status',[AppointmentController::class,'status'])->name('appointments.status');
 Route::post('appointments/{appointment}/checkin',[AppointmentController::class,'checkin'])->name('appointments.checkin');
 Route::get('doctors',[DoctorController::class,'index'])->name('doctors.index');
 Route::middleware('role:administrator')->group(function(){Route::get('doctors/create',[DoctorController::class,'create'])->name('doctors.create');Route::post('doctors',[DoctorController::class,'store'])->name('doctors.store');Route::get('doctors/{doctor}/edit',[DoctorController::class,'edit'])->name('doctors.edit');Route::put('doctors/{doctor}',[DoctorController::class,'update'])->name('doctors.update');Route::post('doctors/{doctor}/toggle',[DoctorController::class,'toggle'])->name('doctors.toggle');});
 Route::middleware('role:administrator,doctor')->group(function(){Route::get('consultations/create',[ConsultationController::class,'create'])->name('consultations.create');Route::post('consultations',[ConsultationController::class,'store'])->name('consultations.store');});
 Route::get('consultations',[ConsultationController::class,'index'])->name('consultations.index')->middleware('role:administrator,doctor,nurse');
 Route::get('billing',[BillingController::class,'index'])->name('billing.index')->middleware('role:administrator,receptionist');
 Route::get('billing/create',[BillingController::class,'create'])->name('billing.create')->middleware('role:administrator,receptionist');
 Route::post('billing',[BillingController::class,'store'])->name('billing.store')->middleware('role:administrator,receptionist');
 Route::get('billing/{invoice}',[BillingController::class,'show'])->name('billing.show')->middleware('role:administrator,receptionist');
 Route::post('billing/{invoice}/payment',[BillingController::class,'payment'])->name('billing.payment')->middleware('role:administrator,receptionist');
 Route::get('settings',[SettingsController::class,'edit'])->name('settings.edit')->middleware('role:administrator');Route::put('settings',[SettingsController::class,'update'])->name('settings.update')->middleware('role:administrator');
 Route::get('staff',[StaffController::class,'index'])->name('staff.index')->middleware('role:administrator');Route::post('staff',[StaffController::class,'store'])->name('staff.store')->middleware('role:administrator');Route::post('staff/{user}/toggle',[StaffController::class,'toggle'])->name('staff.toggle')->middleware('role:administrator');
});
