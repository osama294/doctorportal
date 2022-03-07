<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Doctorslots;
use App\Models\Speciality;
use App\Models\Review;
use App\Models\Illness;
use App\Models\Appoinment;
use App\Models\PatientSymptom;
use App\Models\Symptom;
use Illuminate\Support\Carbon;

class PatientControlles extends Controller
{
     // Get All Doctor 
     public function GetDoctor()
     {
         try {
             $data = User::where('type','=','Doctor')->with('category')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'messgae' => 'Get Doctor List',
                 ]); 
             }else{
                 return response()->json([
                     'data'   => $data,
                     'messgae' => 'No Data Found',
                     'status'  => '200'
                 ]); 
             }
             
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function All_Category()
     {
         try {
             $data = Category::where('status','=', 'Active')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data' => $data,
                     'status' => '200',
                     'message' => 'All Category Main List',
                 ]);
             }else{
                 return response()->json([
                     'status' => '200',
                     'message' => 'No Category Found'
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => '500',
                 'message' => $e->getMessage(),
             ]);
         }
         
     }
 
     public function All_Subcategory()
     {
         try {
             $data = Subcategory::where('status','=', 'Active')->with('category')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'Sub Category',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status'  => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => '500',
                 'message' => $e->getMessage(),
             ]);
         }
         
     }
 
     public function Category_with_subcat($id)
     {
         try {
             $data = Subcategory::where('cat_id',$id)->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data' => $data,
                     'status' => '200',
                     'message' => 'Sub Category With Category',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
 
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
         
     }
 
     public function Subcat_with_Doctor($id)
     {
         // return $id;
         try {
             //  $data = User::where('type','=','Doctor')->with('category','details')->get();
             //  return $data;
             $data = Speciality::where('subcat_id',$id)->with('doctor.category')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'Sub Category Against Doctor',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status'  => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
 
             return response()->json([
                 'status'  => 500,
                 'message' => $e->getMessage(),
             ]);
         }
         
     }
 
     public function Doctor_with_Speciality($id,$date)
     {
         try {
             $doctor     = User::where('id',$id)->with('category')->first();
             $catids = Speciality::where('doctor_id',$id)->pluck('subcat_id');
             $speciality = Subcategory::whereIn('id',$catids)->get();
             $review     = Review::where('doctor_id',$id)->with('user')->get();
             $slots = Doctorslots::where('doctor_id',$id)->where('date',$date)->where('status', '=', 'Available')->get();
             
             if(!$speciality->isEmpty()){
                 return response()->json([
                     'doctor'     => $doctor,
                     'speciality' => $speciality,
                     'slots'      => $slots,
                     'review'     => $review,
                     'status'     => '200',
                     'message'    => 'Doctor Details Speciality And Reviews',
                 ]);
             }else{
                 return response()->json([
                     'doctor'     => $doctor,
                     'speciality' => $speciality,
                     'slots'      => $slots,
                     'review'     => $review,
                     'status'     => '200',
                     'message'    => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
 
             return response()->json([
                 'status'  => 500,
                 'message' => $e->getMessage(),
             ]);
         }
         
     }
 
     public function Get_Doctor_Slot(Request $request)
     {
         try {
             $data = Doctorslots::where('doctor_id',$request->doctor_id)->where('date',$request->date)->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'Doctor Available Slots',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status'  => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status'  => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function Pateint_review(Request $request)
     {
         try {
             $user = Auth::user();
             $row              = new Review();
             $row->doctor_id   = $request->doctor_id;
             $row->patient_id  = $user->id;
             $row->description = $request->description;
             $row->stars       = $request->stars;
             $row->status      = "Active";
             $run              = $row->save();
 
             if($run){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Review added Successfully'
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function Symptoms_List()
     {
         try {
             $data = Symptom::where('status','=', 'Active')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'Symptoms',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status'  => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => '500',
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function Illness_List()
     {
         try {
             $data = Illness::where('status','=', 'Active')->get();
             if(!$data->isEmpty()){
                 return response()->json([
                     'data'   => $data,
                     'status' => '200',
                     'message' => 'Symptoms',
                 ]);
             }else{
                 return response()->json([
                     'data'   => $data,
                     'status'  => '200',
                     'message' => 'No Data Found',
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => '500',
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function Add_Symptoms_Details(Request $request)
     {
         try {
             $user = Auth::user();
             if($request->slots_id){
                 $row = Doctorslots::find($request->slots_id);
                 $row->patient_id = $user->id;
                 $row->status = "Booked";
                 $run = $row->update();
             }
             $appoinment = array(
                 'patient_id'          => $user->id,
                 'doctor_id'           => $request->doctor_id,
                 'slot_id'             => $request->slots_id,
                 'smoke'               => $request->smoke,
                 'diabetes'            => $request->diabetes,
                 'asthma'              => $request->asthma,
                 'allergic'            => $request->allergic,
                 'diagnosed_diabetes'  => $request->diagnosed_diabetes,
                 'diagnosed_heart'     => $request->diagnosed_heart,
                 'diagnosed_kidney'    => $request->diagnosed_kidney,
                 'diagnosed_arthritis' => $request->diagnosed_arthritis,
                 'diagnosed_pulmonary' => $request->diagnosed_pulmonary,
                 'diagnosed_eating'    => $request->diagnosed_eating,
                 'complaint_name'      => $request->complaint_name,
                 'starting_date'       => $request->starting_date,
                 'description'         => $request->description,
                 'appoinment_type'     => $request->appoinment_type,
                 'room_name'           => "RMX".rand(100,999).rand(1000,9999),
                 'status'              => 'Active',
             );
             $appoinmentrun = Appoinment::create($appoinment);
             if($appoinmentrun){
                 foreach ($request->symptom_id as $key => $symptom_id) {
                     $syptoms = array(
                         'appoinment_id' => $appoinmentrun->id,
                         'symptom_id'    => $symptom_id,
                         'doctor_id'     => $request->doctor_id,
                         'patient_id'    => $user->id,
                         'status'        => 'Active',
                     );
                     $symptomsrun = PatientSymptom::create($syptoms);
                 }
                 $this->notification('Your appointment is in process & our team will contact you as soon as possible.');
             }
 
             if($symptomsrun){
                 return response()->json([
                     'status' => 200,
                     'message' => 'Appoinment added Successfully'
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }
 
     public function Check_Availabe_Doctor(Request $request)
     {
         // return $request->all();
         try {
             $subcat_id = Speciality::where('subcat_id',$request->subcat_id)->pluck('doctor_id');
             Doctorslots::wherein('doctor_id',$subcat_id)->where('date',$request->date)->with('doctor.category')->get();
             $doctor_id  = Doctorslots::wherein('doctor_id',$subcat_id)->where('date',$request->date)->pluck('doctor_id');
             $doctor = User::wherein('id',$doctor_id)->with('category')->get();
      
             if(!$doctor->isEmpty()){
                 return response()->json([
                     'doctor'     => $doctor,
                     'status'     => '200',
                     'message'    => 'Available Doctors',
                 ]);
             }else{
                 return response()->json([
                     'doctor'     => $doctor,
                     'status'  => '200',
                     'message' => 'No Docotor Available',
                 ]);
             }
         } catch (\Exception $e) {
 
             return response()->json([
                 'status'  => 500,
                 'message' => $e->getMessage(),
             ]);
         }
 
     }

     public function Pateint_Appoinment()
     {
         try {
             $user = Auth::user();
             $current_date = Carbon::now();
             $data = Appoinment::select('id','patient_id','doctor_id','slot_id','appoinment_type','room_name')->whereDate('created_at', '>=',$current_date)->where('patient_id',$user->id)->with('doctor:id,name,hospital_name,cat_id','slot:id,start_time,end_time')->get();
             if($data){
                 return response()->json([
                     'data' => $data,
                     'status' => 200,
                     'message' => 'Patient Appoinment'
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }


     public function Pateint_Appoinment_Past()
     {
         try {
            $current_date = Carbon::now();
            $user = Auth::user();
            $data = Appoinment::select('id','patient_id','doctor_id','slot_id','appoinment_type','room_name','created_at')->whereDate('created_at', '<',$current_date)->where('patient_id',$user->id)->with('doctor:id,name,hospital_name,cat_id','slot:id,start_time,end_time')->get();
             if($data){
                 return response()->json([
                     'data' => $data,
                     'status' => 200,
                     'message' => 'Patient Past Appoinment'
                 ]);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
     }

     public function notification($msg){
        $user = Auth::user();
        $fcm = $user->fcm_token;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $notification = [
            'title' => 'Notification',
            'body'  => $msg,
            'type'  => 'test',
        ];
        $fcmNotification = [
            'registration_ids'=>["$fcm"],
                 //device token
            'notification' => $notification
        ];
        $headers = [
            'Authorization: key=' . "AAAAXBT9WTg:APA91bEGubDqePoFV3XDHEuyy65-qQdePH-gknEw1DKSKh_oI3dFpnbhDIgD0eGHusBkstzHZnGI-fzsd7GGxfcdCmrZkMNAS6uFEC73MXfb0oq_rIs0sowzSt8_7pYfCk_qw4oAatn7",
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        echo $result = curl_exec($ch);
        curl_close($ch);
     }

}
