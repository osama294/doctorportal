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

class DoctorControlles extends Controller
{
    public function Add_Slot(Request $request)
    {
        $Date1 = $request->from;
        $Date2 = $request->to;
        // Declare an empty array
        $array = array();
        // Use strtotime function
        $Variable1 = strtotime($Date1);
        $Variable2 = strtotime($Date2);
        // Use for loop to store dates into array
        // 86400 sec = 24 hrs = 60*60*24 = 1 day
        for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400)) {
            $Store = date('Y-m-d', $currentDate);
            $array[] = $Store;
        }

        // return $request->all();
        $doctor = Auth::user();
        try {

            // foreach ($request->start_time as $key => $start_time) {
            //     $slots = array(
            //         'doctor_id'   => $doctor->id,
            //         'date'        => $request->date,
            //         'start_time'  => $start_time,
            //         'end_time'    => $request->end_time[$key],
            //         'description' => $request->description[$key],
            //         'total'       => 0,
            //         'status'      => 'Available',
            //     );
            //     $run = Doctorslots::create($slots);
            // }
            
            foreach($array as $rw){
                
                foreach ($request->start_time as $key => $time) {

                    $slots = array(
                        'doctor_id'   => $doctor->id,
                        'date'        => $rw,
                        'start_time'  => $time,
                        'end_time'    => $request->end_time[$key],
                        'description' => $request->description,
                        'total'       => 0,
                        'status'      => 'Available',
                    );
                    
                    $run = Doctorslots::create($slots);
                }

            }

            if($run){
                return response()->json([
                    'status' => '200',
                    'message' => 'Slots added Successfully'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function Update_Slot(Request $request, $id)
    {
        try{
     
            $slot              = Doctorslots::find($id);
            $slot->date        = $request->date;
            $slot->start_time  = $request->start_time;
            $slot->end_time    = $request->end_time;
            $slot->description = $request->description;
            $up                = $slot->update();

            if($up){
                return response()->json([
                    'data' => $slot,
                    'status' => '200',
                    'message' => 'Slots Update Successfully'
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function Delete_Slot($id)
    {
        $row = Doctorslots::find($id);
        $run = $row->delete();
        if($run){
            return response()->json([
                'status' => '200',
                'message' => 'Slots Delete Successfully'
            ]);
        }
       
    }

    public function Add_Speciality(Request $request)
    {
        try {
            $doctor = Auth::user();
            $row = Speciality::where('doctor_id',$doctor->id)->delete();

                foreach ($request->speciality as $key => $subcat_id) {
                    $slots = array(
                        'subcat_id' => $subcat_id,
                        'doctor_id' => $doctor->id,
                        'status'    => 'Active',
                    );
                    $run = Speciality::create($slots);
                }
            if($run){
                return response()->json([
                    'status' => "200",
                    'message' => 'Speciality added Successfully'
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function Doctor_Sucategory()
    {
   
        try {
            $doctor = Auth::user();
            $data = Subcategory::where('cat_id',$doctor->cat_id)->get();
            // $doc_speciality = Speciality::where('doctor_id',$doctor->id)->pluck('subcat_id');
            // $speciality2 = Subcategory::whereIn('id',$doc_speciality)->get();
            // $speciality = Speciality::where('doctor_id',$doctor->id)->with('subcategory')->get();
           
            if(!$data->isEmpty()){
                return response()->json([
                    'data'   => $data,
                    'status' => '200',
                    'message' => 'Doctor Speciality List',
                ]);
            }else{
                return response()->json([
                    'data'   => $data,
                    'status'  => '200',
                    'message' => 'No Speciality Found',
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function Doctor_Speciality_list()
    {
   
        try {
            $doctor = Auth::user();
            $doc_speciality = Speciality::where('doctor_id',$doctor->id)->pluck('subcat_id');
            $data = Subcategory::whereIn('id',$doc_speciality)->get();
           
            if(!$data->isEmpty()){
                return response()->json([
                    'data'   => $data,
                    'status' => '200',
                    'message' => 'Doctor Speciality List',
                ]);
            }else{
                return response()->json([
                    'data'   => $data,
                    'status'  => '200',
                    'message' => 'No Speciality Found',
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function Total_slots()
    {
        $doctor = Auth::user();
        $data = Doctorslots::where('doctor_id',$doctor->id)->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Total Slots',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }

    public function Booked_slots()
    {
        $doctor = Auth::user();
        $data = Doctorslots::where('doctor_id',$doctor->id)->where('status', '=', 'Booked')->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Booked Slot',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }

    public function Available_slots()
    {
        $doctor = Auth::user();
        $data = Doctorslots::where('doctor_id',$doctor->id)->where('status', '=', 'Available')->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Available Slots',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }

    public function Get_Date_Slots($id)
    {
        $doctor = Auth::user();
        $data = Doctorslots::where('doctor_id',$doctor->id)->where('date',$id)->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Date Wise Slot',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }

    public function ReviewsList()
    {
        $user = Auth::user();
        $data     = Review::where('doctor_id',$user->id)->with('user')->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Reviews',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }

    public function Doctor_Appoinment()
    {
        $user        = Auth::user();
        $current_date = Carbon::now();
        $data = Appoinment::select('id','patient_id','doctor_id','slot_id','complaint_name','description')->whereDate('created_at', '>=',$current_date)->where('doctor_id',$user->id)->with('patient:id,name','slot:id,date,start_time')->get();
        if(!$data->isEmpty()){
            return response()->json([
                'data'   => $data,
                'status' => '200',
                'message' => 'Appointment',
            ]);
        }else{
            return response()->json([
                'data'   => $data,
                'status'  => '200',
                'message' => 'No Data Found',
            ]);
        }
    }
    

    public function Doctor_Appoinment_Past()
    {
         try {
            $current_date = Carbon::now();
            $user = Auth::user();
            $data = Appoinment::select('id','patient_id','doctor_id','slot_id','complaint_name','description')->whereDate('created_at', '<',$current_date)->where('doctor_id',$user->id)->with('patient:id,name','slot:id,date,start_time')->get();
             if(!$data->isEmpty()){
                return response()->json([
                    'data' => $data,
                     'status' => "200",
                     'message' => 'Doctor Past Appoinment'
                ]);
            }else{
                return response()->json([
                    'data'   => $data,
                    'status'  => '200',
                    'message' => 'No Doctor Past Appoinment Right Now',
                ]);
            }
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 500,
                 'message' => $e->getMessage(),
             ]);
         }
    }
}
