<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Illness;
use App\Models\User;
use App\Models\Review;
use App\Models\Role;

class UserController extends Controller
{



    public function DoctorList()
    {
        $doctors = User::where('type','=','Doctor')->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function DoctorStor(Request $request)
    {
        try {
            $row                 = new User();
            $row->name           = $request->name;
            $row->email          = $request->email;
            $row->password       = $request->password;
            $row->contact        = $request->contact;
            $row->gender         = $request->gender;
            $row->date_of_birth  = $request->date_of_birth;
            $row->medical_record = $request->medical_record;
            $row->type           = $request->type;
            $row->status         = 'Active';
            $run                 = $row->save();

            if ($run) {
                return redirect()->route('doctor_list')->with('success','Doctors Add Succesfully');
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
    
    public function PatientList()
    {
        $patients = User::where('type','=','Patient')->get();
        return view('admin.patient.index', compact('patients'));
    }

    public function UsertList()
    {
        $doctors = User::where('type','=','User')->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function ChangeStatus(Request $request)
    {
        $row = User::where('id',$request->id)->first();
        if($row->status == 'Active')
        {
            $row->status = 'Disabled';
        }else{
            $row->status = 'Active';
        }
        $run = $row->update();
        if($run){
            return  $rows = User::where('id',$request->id)->first();
        }
    }

    public function Profile()
    {
        $user = Auth::user();
        if($user->type == 'Doctor'){
            $doctors = Auth::user();
            return view('admin.doctor.doctor_profile', compact('doctors'));
        }elseif($user->type == 'Admin'){
            $doctors = Auth::user();
            return view('admin.adminmaster.profile', compact('doctors'));
        }
    }


    public function index()
    {
        $users = User::where('id','!=', 1)->with('roles')->get();
        // $users = User::where('id','!=', 1)->with('roles')->get();
        // return $users;
        $roles = Role::all();
        // return view('admin.subject.index', compact('subjects'));
        return view('admin.adminstrator.user.index', compact('users','roles'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rolid' => ['required']
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $row           = new User();
            $row->name     = $request->name;
            $row->email    = $request->email;
            $row->type    = "Admin";
            $row->password = bcrypt($request->password);
            $run=$row->save();
            $row->syncRoles([$request->rolid]);

            if ($run) {
                return redirect()->route('user.index')->with('success','User Add Sucsesfulyy...');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $row = User::find($id);
        return view('admin.adminstrator.user.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        try{
            $row           = User::find($id);
            $row->name     = $request->name;
            $row->email    = $request->email;
            $run=$row->update();
            // $row->syncRoles([$request->rolid]);

            if ($run) {
                return redirect()->route('user.index')->with('success','User Update Sucsesfulyy...');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function assignRolFunction($id)
    {
        // return $id;
        $row = User::find($id);
        $roles = Role::all();
        return view('admin.adminstrator.user.assign_role', compact('row','roles'));
    }

    public function RolInsertFunction(Request $request, $id)
    {
        // dd($request->all());
        try{
            $row           = User::find($id);
            $row->name     = $request->name;
            $row->email    = $request->email;
            $run=$row->update();
            $row->syncRoles([$request->rolid]);

            if ($run) {
                return redirect()->route('user.index')->with('message','Role Hase Been Assign Sucsesfulyy...');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


}
