<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\PatientControlles;
use App\Http\Controllers\API\DoctorControlles;


Route::post('access_token',[ApiController::class,'generate_token']);

Route::post('signup',[ApiController::class,'signup']);

Route::post('signin',[ApiController::class,'login']);

Route::post('social_login',[ApiController::class,'Social_Login']);

Route::post('forgotpassword',[ApiController::class,'ForgotPassword']);
Route::post('send_notification',[ApiController::class,'send_notification']);

Route::get('category',[PatientControlles::class,'All_Category']);

Route::group(['middleware' => ['auth:sanctum']],function (){

    Route::post('userprofile', [ApiController::class,'user']);
    
    Route::get('doctor_profile', [ApiController::class,'Doctor_profile']);
    
    Route::post('editproflie',[ApiController::class,'Update_Profile']);

    Route::post('doctoreditproflie',[ApiController::class,'Update_Profile_Doctor']);
    
    Route::get('subcategory',[PatientControlles::class,'All_Subcategory']);
    
    Route::get('category_subcat/{id}',[PatientControlles::class,'Category_with_subcat']);
    
    Route::get('doctor',[PatientControlles::class,'GetDoctor']);
    
    Route::get('subcat_doctor/{id}',[PatientControlles::class,'Subcat_with_Doctor']);
    
    Route::get('doctor_speciality/{id}/{date}',[PatientControlles::class,'Doctor_with_Speciality']);
    
    Route::post('doctor_slots', [PatientControlles::class,'Get_Doctor_Slot']);

    Route::post('review', [PatientControlles::class,'Pateint_review']);
    
    Route::get('symptoms', [PatientControlles::class,'Symptoms_List']);

    Route::get('illness', [PatientControlles::class,'Illness_List']);
    
    Route::post('check_availabe_doctor', [PatientControlles::class,'Check_Availabe_Doctor']);

    Route::post('add_symptoms', [PatientControlles::class,'Add_Symptoms_Details']);

    Route::get('pateint_appoinment', [PatientControlles::class,'Pateint_Appoinment']);

    Route::get('pateint_appoinment_past', [PatientControlles::class,'Pateint_Appoinment_Past']);

    Route::post('add_slot', [DoctorControlles::class,'Add_Slot']);

    Route::get('add_speciality', [DoctorControlles::class,'Add_Speciality']);

    Route::get('show_all_subcat', [DoctorControlles::class,'Doctor_Sucategory']);

    Route::post('doctor_own_speciality', [DoctorControlles::class,'Doctor_Speciality_list']);

    Route::post('update_slot/{id}', [DoctorControlles::class,'Update_Slot']);

    Route::get('delete_slot/{id}', [DoctorControlles::class,'Delete_Slot']);

    Route::get('total_slot', [DoctorControlles::class,'Total_Slots']);

    Route::get('booked_slot', [DoctorControlles::class,'Booked_slots']);

    Route::get('available_slot', [DoctorControlles::class,'Available_slots']);

    Route::get('date_slot/{id}', [DoctorControlles::class,'Get_Date_Slots']);

    Route::get('reviews', [DoctorControlles::class,'ReviewsList']);

    Route::get('appoinment', [DoctorControlles::class,'Doctor_Appoinment']);

    Route::get('appoinment_past', [DoctorControlles::class,'Doctor_Appoinment_Past']);
   
});
