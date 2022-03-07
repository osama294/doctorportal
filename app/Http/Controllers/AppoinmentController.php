<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\User;
use App\Models\PatientSymptom;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $appoinments = Appoinment::with('doctor:id,name,cat_id','patient:id,name')->get();
        return view('admin.appoinment.index', compact('appoinments'));
    }

    public function PatientAppoinmentDetails(Request $request)
    {
        $patient    = User::where('id',$request->patientid)->first();
        $appoinment = Appoinment::with('patient','slot')->where('id',$request->appoinmentid)->first();
        $symptomid  = PatientSymptom::where('patient_id',$request->patientid)->where('appoinment_id',$request->appoinmentid)->pluck('symptom_id');
        $symptoms   = Symptom::whereIn('id',$symptomid)->get();
            return response()->json([
                'patient'    => $patient,
                'appoinment' => $appoinment,
                'symptom'    => $symptoms
            ]);

    }

    public function PatientAppoinment(Request $request)
    {
         $appoinment   = Appoinment::with('slot','doctor','patientsymptom.symptom')->where('patient_id',$request->id)->first();
         if($appoinment){
             return $appoinment;
         }else{
             return "No Data";
         }
    }

    public function Doctor_Appoinment_List()
    {
        $user        = Auth::user();
        $appoinments = Appoinment::where('doctor_id',$user->id)->with('doctor:id,name,cat_id','patient:id,name')->get();
        return view('admin.appoinment.doctor_appoinment', compact('appoinments'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function show(Appoinment $appoinment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appoinment $appoinment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appoinment $appoinment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appoinment $appoinment)
    {
        //
    }
}
