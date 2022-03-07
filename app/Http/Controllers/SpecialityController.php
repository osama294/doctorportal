<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Auth::user();
        $subcate = Subcategory::where('cat_id',$doctor->cat_id)->get();
        $doc_speciality = Speciality::where('doctor_id',$doctor->id)->pluck('subcat_id');
        $speciality2 = Subcategory::whereIn('id',$doc_speciality)->get();
        $speciality = Speciality::where('doctor_id',$doctor->id)->with('subcategory')->get();
        // return $speciality;  
        return view('admin.speciality.index', compact('speciality','subcate','doc_speciality','speciality2'));
    }

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
        // return $request->all();
        $doctor = Auth::user();
        // return $doctor;
        try {
            $row = Speciality::where('doctor_id',$doctor->id)->delete();
                foreach ($request->speciality as $key => $subcat_id) {
                    $slots = array(
                        'subcat_id'        => $subcat_id,
                        'doctor_id'   => $doctor->id,
                        'status'      => 'Active',
                    );
                    $run = Speciality::create($slots);
                }
            // $row            = new Speciality();
            // $row->subcat_id      = $request->cat_id;
            // $row->doctor_id      = $doctor->id;
            // $row->status    = 'Active';
            // $run = $row->save();

            if ($run) {
                return redirect()->route('speciality.index')->with('success','Speciality Added Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit(Speciality $speciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speciality $speciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Speciality::where('subcat_id',$id)->delete();
        // $run = $row->delete();
        if ($row){
            return redirect()->route('speciality.index')->with('msg','Your Speciality Delete Succesfully');
        }
    }
}
