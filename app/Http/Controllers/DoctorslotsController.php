<?php

namespace App\Http\Controllers;

use App\Models\Doctorslots;
use App\Models\Subcategory;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorslotsController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();
        $current_date = Carbon::now()->toDateString();
        // return $current_date;
        $slots = Doctorslots::where('doctor_id',$doctor->id)->whereDate('date',$current_date)->get();
        // return $slots;
        return view('admin.doctor_slots.index', compact('slots'));
    }

    public function Booked_slots()
    {
        $doctor = Auth::user();
        $current_date = Carbon::now()->toDateString();
        // return $current_date;
        $slots = Doctorslots::where('doctor_id',$doctor->id)->where('status', '=', 'Booked')->get();
        // return $slots;
        return view('admin.doctor_slots.booked_slots', compact('slots'));
    }

    public function Available_slots()
    {
        $doctor = Auth::user();
        $current_date = Carbon::now()->toDateString();
        // return $current_date;
        $slots = Doctorslots::where('doctor_id',$doctor->id)->where('status', '=', 'Available')->get();
        // return $slots;
        return view('admin.doctor_slots.available_slots', compact('slots'));
    }

    public function Total_slots()
    {
        $doctor = Auth::user();
        $current_date = Carbon::now()->toDateString();
        // return $current_date;
        $slots = Doctorslots::where('doctor_id',$doctor->id)->get();
        // return $slots;
        return view('admin.doctor_slots.total_slots', compact('slots'));
    }

    public function Selected_Date_slots()
    {
        return view('admin.doctor_slots.check_date_slots');
    }

    public function Get_Date_Slots($id)
    {
        // return $id;
        $doctor = Auth::user();
        $slots = Doctorslots::where('doctor_id',$doctor->id)->where('date',$id)->get();
        // return $slots;
        if($slots)
        {
            return $slots;
        }else{
            return "No Data Found";
        }

    }

    public function Doctor_Date_slots(Request $request)
    {
        $doctor = Auth::user();
        $slots['slots'] = Doctorslots::where('doctor_id',$doctor->id)->where('date',$request->date)->get();
        return view('admin.doctor_slots.check_date_slots', $slots);
    }

    public function store(Request $request)
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
        // Display the dates in array format
        // print_r($array);
        // return $request->all();
        $doctor = Auth::user();

        foreach($array as $rw){
            
            foreach ($request->start_time as $key => $time) {

                $slots = array(
                    'doctor_id'   => $doctor->id,
                    'date'        => $rw,
                    'start_time'  => $time,
                    'end_time'    => $request->end_time[$key],
                    'description' => $request->description[$key],
                    'total'       => $request->total,
                    'status'      => 'Available',
                );
                
                $run = Doctorslots::create($slots);
            }

        }
        if ($run) {
            return  redirect()->route('doctor_slots.index')->with('success','Slots Added SuccessFully..!');
        }

        // try {
        //     foreach ($request->start_time as $key => $start_time) {

        //         $slots = array(
        //             'doctor_id'   => $doctor->id,
        //             'date'        => $request->date,
        //             'start_time'  => $start_time,
        //             'end_time'    => $request->end_time[$key],
        //             'description' => $request->description[$key],
        //             'total'       => $request->total,
        //             'status'      => 'Available',
        //         );
        //         $run = Doctorslots::create($slots);
        //     }
        //     if ($run) {
        //         return  redirect()->route('doctor_slots.index')->with('success','Slots Add SuccessFully..!');
        //     }

        // } catch (\Exception $e) {

        //     return $e->getMessage();
        // }
    }


    public function edit($id)
    {
        $row = Doctorslots::find($id);
        return view('admin.doctor_slots.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        try{
     
            $slot              = Doctorslots::find($id);
            $slot->date        = $request->date;
            $slot->start_time  = $request->start_time;
            $slot->end_time    = $request->end_time;
            $slot->description = $request->description;
            $up                = $slot->update();

            if ($up){
                return redirect()->route('doctor_slots.index')->with('success','Slots Update Successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $row = Doctorslots::find($id);
        $run = $row->delete();
        if ($run){
            return redirect()->route('doctor_slots.index')->with('msg','Your Slots Delete Succesfully');
        }
    }


}
