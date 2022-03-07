<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\IllnessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\DoctorslotsController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AppoinmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::fallback(function(){
//     return view('404');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']],function (){

    Route::get('profile', [UserController::class,'Profile'])->name('profile');

    // Admin Routes Starts
    Route::resource('category', CategoryController::class);
    Route::get('categorydel/{id}', [CategoryController::class,'destroy']);
    Route::post('categroy_status', [CategoryController::class,'ChangeStatus'])->name('categroy_status');
    
    Route::resource('subcategory', SubcategoryController::class);
    Route::get('subcategorydel/{id}', [SubcategoryController::class,'destroy']);
    Route::post('subcategroy_status', [SubcategoryController::class,'ChangeStatus'])->name('subcategroy_status');
    
    Route::resource('illnes', IllnessController::class);
    Route::post('illnesupdate/{id}', [IllnessController::class,'Illnes_Update'])->name('illnesupdate');
    Route::get('ilnesdel/{id}', [IllnessController::class,'destroy']);
    Route::post('illness_status', [IllnessController::class,'ChangeStatus'])->name('illness_status');
    Route::get('illnes_test', [IllnessController::class,'Illness_Test'])->name('illnes_test');
    Route::post('testinsert', [IllnessController::class,'Illness_insert'])->name('testinsert');
    Route::get('testgetdata', [IllnessController::class,'GetData'])->name('testgetdata');
    Route::post('illness_model_show_data', [IllnessController::class,'Illness_Model'])->name('illness_model_show_data');
    Route::post('illnesupdatemodel', [IllnessController::class,'Illnes_Update_Data'])->name('illnesupdatemodel');
    
    Route::resource('symptom', SymptomController::class);
    // Route::get('symptomlist', [SymptomController::class, 'getSymptom'])->name('symptomlist');
    Route::post('symptomupdate/{id}', [SymptomController::class,'Symptom_Update'])->name('symptomupdate');
    Route::get('symptomdel/{id}', [SymptomController::class,'destroy']);
    Route::post('symptom_status', [SymptomController::class,'ChangeStatus'])->name('symptom_status');
    
    
    Route::get('doctor_list', [UserController::class,'DoctorList'])->name('doctor_list');
    Route::post('doctor_store', [UserController::class,'DoctorStor'])->name('doctor_store');
    Route::get('userdel/{id}', [UserController::class,'destroy']);
    
    Route::get('patient_list', [UserController::class,'PatientList'])->name('patient_list');
    Route::get('user_list', [UserController::class,'UsertList'])->name('user_list');
    Route::post('user_status', [UserController::class,'ChangeStatus'])->name('user_status');

    Route::resource('appoinment', AppoinmentController::class);
    Route::post('patient_appoinment_details', [AppoinmentController::class, 'PatientAppoinmentDetails']);
    Route::post('patient_appoinment', [AppoinmentController::class, 'PatientAppoinment']);

    // Admin Routes ENded
    
    
    
    // Doctor Route Starts

    Route::resource('doctor', DoctorsController::class);
    Route::get('doctor_profile', [DoctorsController::class,'Doctor_Profile'])->name('doctor_profile');
    Route::post('adddoctordetails', [DoctorsController::class,'DoctorSubDetail'])->name('adddoctordetails');
    Route::post('doctorupdate', [DoctorsController::class,'DoctorUpdate'])->name('doctorupdate');
    Route::post('doctorupdate_admin', [DoctorsController::class,'DoctorUpdate_admin'])->name('doctorupdate_admin');
    Route::post('doctordetailsupdate/{id}', [DoctorsController::class,'DoctorSubDetailUpdate'])->name('doctordetailsupdate');
    Route::post('doctor_details', [DoctorsController::class, 'DoctorProfileDetails']);
    Route::post('imagedelete/{id}', [DoctorsController::class,'ImageDelete'])->name('imagedelete');
    Route::get('reviews_list', [DoctorsController::class,'ReviewsList'])->name('reviews_list');
    Route::post('patient_details', [DoctorsController::class, 'PatientProfileDetails']);

    Route::resource('speciality', SpecialityController::class);
    Route::get('specialitydel/{id}', [SpecialityController::class,'destroy']);

    Route::resource('doctor_slots', DoctorslotsController::class);
    Route::get('doctor_slotsdel/{id}', [DoctorslotsController::class,'destroy']);
    Route::get('doctor_slots_book', [DoctorslotsController::class,'Booked_slots'])->name('doctor_slots_book');
    Route::get('doctor_slots_available', [DoctorslotsController::class,'Available_slots'])->name('doctor_slots_available');
    Route::get('doctor_slots_total', [DoctorslotsController::class,'Total_slots'])->name('doctor_slots_total');
    Route::get('doctor_slots_check_date', [DoctorslotsController::class,'Selected_Date_slots'])->name('doctor_slots_check_date');
    Route::post('check_date_slot', [DoctorslotsController::class,'Doctor_Date_slots'])->name('check_date_slot');
    // Route::post('getdateslots/{id}', [DoctorslotsController::class,'Get_Date_Slots'])->name('getdateslots');

    Route::get('doctor_appoinment', [AppoinmentController::class, 'Doctor_Appoinment_List'])->name('doctor_appoinment');


    // Doctor Route Ended




      // Adminastration Route
      Route::resource('user', UserController::class);
      Route::get('assignrole/{id}', [UserController::class,'assignRolFunction'])->name('assignrole');
      Route::post('assigninsert/{id}', [UserController::class,'RolInsertFunction'])->name('assigninsert');
  
      Route::resource('role', RoleController::class);
      Route::get('assigpermission/{id}', [RoleController::class,'editpermission'])->name('assigpermission');
      Route::post('insertAndUpdatepermission/{id}', [RoleController::class,'updatepermission'])->name('insertAndUpdatepermission');
      Route::resource('permission', PermissionController::class);




    Route::get('/video_chat', function () {
        return view('welcome');
    });
});

