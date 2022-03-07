<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use App\Models\PatientIllnes;
use App\Models\Illness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Image;

class DoctorsController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $doctors    = User::where('type','=','Doctor')->with('category')->get();
        return view('admin.doctor.index', compact('doctors','categories'));
    }

    public function store(Request $request)
    {
        try {

            $row                 = new User();
            $row->name           = $request->name;
            $row->email          = $request->email;
            $row->password       = bcrypt($request->password);
            $row->contact        = $request->contact;
            $row->gender         = $request->gender;
            $row->date_of_birth  = $request->date_of_birth;
            $row->medical_record = $request->medical_record;
            $row->type           = 'Doctor';
            $row->cat_id         = $request->cat_id;
            $row->status         = 'Active';
            $run                 = $row->save();

            if ($run) {
                return redirect()->route('doctor.index')->with('success','Doctors Added Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function DoctorSubDetail(Request $request)
    {
        // return $request->all();
        $user = Auth::user();
        try {
            $item = array(
                'account_id'    => $user->id,
                'description'   => $request->description,
                'hospital_name' => $request->hospital_name,
                'fees'          => $request->fees_amount,
                'status'        => 'Active',
            );
            $image        = $request->file('image');
            $extension    = $image->getClientOriginalExtension();
            $filename     = time() . '.'.$extension;
            $image_resize = \Image::make($image->getRealPath());
            $image_resize->resize(150,150);
            $image_resize->save(public_path('image/user/'.$filename));
                  $url     = 'image/user/'.$filename;
            $item['image'] = $filename;
            $item['url']   = $url;
                  $insert  = Doctors::create($item);
    
            if ($insert) {
                return redirect()->back()->with('success','Details Added Succesfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function DoctorUpdate(Request $request)
    {
        try {

            $row                 = User::find($request->id);
            $row->name           = $request->name;
            $row->email          = $request->email;
            $row->password       = bcrypt($request->password);
            $row->contact        = $request->contact;
            $row->gender         = $request->gender;
            $row->date_of_birth  = $request->date_of_birth;
            $row->medical_record = $request->medical_record;
            $run = $row->update();
            if ($run) {
                return $row;
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function DoctorSubDetailUpdate(Request $request, $id)
    {
        // return $request->all();
        try {
            if($request->hasFile('image')) {
                $image        = $request->file('image');
                $filename     = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('image/user/' .$filename));
                $url = 'image/user/'.$filename;

                $setting                  = User::find($id);
                $setting->image           = $filename;
                $setting->url             = $url;
                $setting->description     = $request->description;
                $setting->hospital_name   = $request->hospital_name;
                $setting->fees            = $request->fees_amount;
                $setting->education       = $request->education;
                $setting->work_experience = $request->work_experience;
               
            }else{

                $setting                = User::find($id);
                $setting->description   = $request->description;
                $setting->hospital_name = $request->hospital_name;
                $setting->fees          = $request->fees_amount;
                $setting->education       = $request->education;
                $setting->work_experience = $request->work_experience;
              
            }

            $up = $setting->update();

            if ($up){
                return redirect()->route('doctor_profile')->with('success','Record  Update Successfully...');
            }

            // Test
        } catch (\Exception $e) {
            return $e->getMessage();
        }

           
    }

    public function ReviewsList()
    {
        $user    = Auth::user();
        $reviews = Review::where('doctor_id',$user->id)->with('user')->get();
        return view('admin.review.index', compact('reviews'));
    }

    
    public function show(Doctors $doctors)
    {
        //
    }

   
    public function edit($id)
    {
        // return $id;
        $categories = Category::all();
        $doctors    = User::find($id);
        return view('admin.doctor.edit', compact('doctors','categories'));
    }

    
    public function DoctorUpdate_admin(Request $request)
    {
        try {
            $row                = User::find($request->id);
            $row->name          = $request->name;
            $row->email         = $request->email;
            $row->password      = bcrypt($request->password);
            $row->contact       = $request->contact;
            $row->gender        = $request->gender;
            $row->date_of_birth = $request->date_of_birth;
            $row->cat_id        = $request->cat_id;
            $run                = $row->update();

            if ($run) {
                return $row;
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

   
    public function destroy($id)
    {
        $row = User::find($id);
        $run = $row->delete();
        if ($run){
            return redirect()->route('doctor.index')->with('msg','User Delete Succesfully');
        }
    }

    public function Doctor_Profile()
    {
        $doctors = Auth::user();
        return view('admin.doctor.doctor_profile', compact('doctors'));
    }
    
    public function DoctorProfileDetails(Request $req){
        
        $doctor['Profile'] = User::where('id',$req->docID)->with('category')->first();
        //show age of doctor instead of DOB
        $doctor['age']        = Carbon::parse($doctor['Profile']->date_of_birth)->age;
                $givenReviews = Review::where('doctor_id',$req->docID)->count();
            if(!$givenReviews == 0){
                    $reviewsCount = Review::where('doctor_id',$req->docID)->sum('stars');
                    $totalStars   = $givenReviews * 5 ;
            $doctor['star']       = $reviewsCount / $totalStars * 100;
            }else{
            $doctor['star'] = 0;
            return response()->json($doctor);
        }
         return response()->json($doctor);
    }

    public function PatientProfileDetails(Request $request){
        $patient   = User::where('id',$request->id)->first();
        $illnessid = PatientIllnes::where('patient_id',$request->id)->pluck('illness_id');
        $illness   = Illness::whereIn('id',$illnessid)->get();
        $review    = Review::where('patient_id',$request->id)->with('userdoctor')->get();
            return response()->json([
                'personal' => $patient,
                'illness'  => $illness,
                'review'   => $review
            ]);
    }

    public function ImageDelete(Request $request, $id){
        $row        = User::find($id);
        $row->image = NULL;
        $row->url   = NULL;
        $run        = $row->update();
        if ($run) {
            return $row;
        }
    }
}

