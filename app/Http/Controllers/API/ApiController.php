<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User; 
use App\Models\PatientSymptom; 
use App\Models\PatientIllnes; 
use App\Models\Illness; 
use App\Models\Doctorslots;
use App\Models\Speciality;
use App\Models\Subcategory;
use App\Models\Appoinment;
use Image;
use Illuminate\Support\Carbon;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class ApiController extends Controller
{
    public function generate_token(Request $request)
    {
        // return "Sucsess";
        // Substitute your Twilio Account SID and API Key details

        $accountSid   ='AC705d9a8ba5109dad027f5a4beb297d9b';
        $apiKeySid    ='SK0dcc632dae36f60b190a54db18557076';
        $apiKeySecret = 'CaSuqx0biPUiy6WX5ynDHg6u1Pci9W9y';
        $identity     = $request->identity;
        $room_name    = $request->room_name;

        // Create an Access Token

        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity,
            $room_name
        );

        // Grant access to Video
        $grant = new VideoGrant();
        // $grant->setRoom('');
        $token->addGrant($grant);
        // Serialize the token as a JWT
        $result=[
            "identity"     => $identity,
            "accountSid"   => $accountSid,
            "apiKeySid"    => $apiKeySid,
            "apiKeySecret" => $apiKeySecret,
            "room_name"    => $room_name,
            "token"        => $token->toJWT()
        ];
        return response()->json($result);
    }

    public function signup(Request $request)
    {
        $role = [
            'name'     => 'required|min:1',
            'email'    => 'required|unique:users',
            // 'contact'  => 'required|max:11|unique:users',
            'address'  => 'required',
            'password' => 'required|confirmed|min:8',
            'image' => 'required',
        ];

        // return $role;

        $validateData = Validator::make($request->all(),$role);

        if($validateData->fails()){

            return response()->json([
                'message' => 'All fields are required',
                'Error' => $validateData->errors(),
            ], 400);

        }
        try {
            $data = array(
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => bcrypt($request->password),
                'contact'        => $request->contact,
                'address'        => $request->address,
                'gender'         => $request->gender,
                'date_of_birth'  => $request->date_of_birth,
                'type'           => $request->type,
                'cat_id'         => $request->cat_id,
                'status'         => "Active",
            );
            // return $data;
            if($request->hasFile('image')) {

                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('image/user/' .$filename));
                // $data['company_logo'] = $filename;
                $url = 'image/user/'.$filename;
                $data['image'] = $filename;
                $data['url'] = $url;

            }
            // return $data;
            $run = User::create($data);

            if($run){
                $response['data']        = $run;
                $response['type']        = $run->type;
                $token         = $run->createToken('access-token');
                $response['accessToken'] = $token->plainTextToken;
                $response['status']      = '200';
                $response['message']     = 'login successfully';
                return response($response, 200)->header('Content-Type', 'application/json');
            }

        } catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => $e->getMessage(),
            ]);
        }
        
        
    }

    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials,true)) {


            $userrecord = Auth::user();

            
            $userrecord->fcm_token = $request->fcm_token;
            $run = $userrecord->update();


            $response['data']        = Auth::user();
            $response['type']        = Auth::user()->type;
                      $token         = Auth::user()->createToken('access-token');
            $response['accessToken'] = $token->plainTextToken;
            $response['status']      = '200';
            $response['message']     = 'login successfully';
            return response($response, 200)->header('Content-Type', 'application/json');

        } else {
            $response['message'] = 'invalid Username or password';
            $response['status']  = '403';
            return response($response, 403)->header('Content-Type', 'application/json');
        }
    }

    public function Social_Login(Request $request) 
    {
        // return $request->all();
         $user = User::where('social_id',$request->social_id)->first();
        if ($user) {
            $response['data']        = $user;
            $token         = $user->createToken('access-token');
            $response['accessToken'] = $token->plainTextToken;
            $response['status']      = '200';
            $response['message']     = 'login successfully';
            return response($response, 200)->header('Content-Type', 'application/json');

        }else{
            $newPass = str::random(8);

            $data = array(
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($newPass),
                'social_id' => $request->social_id,
                'type'      => $request->type,
                'cat_id'    => $request->cat_id,
                'status'    => "Active",
            );

            if($request->hasFile('image')) {
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('image/user/' .$filename));
                // $data['company_logo'] = $filename;
                $url = 'image/user/'.$filename;
                $data['image'] = $filename;
                $data['url'] = $url;
            }
            $run = User::create($data);
                $response['data']        = $run;
                          $token         = $run->createToken('access-token');
                $response['accessToken'] = $token->plainTextToken;
                $response['status']      = '200';
                $response['message']     = 'login successfully';
                return response($response, 200)->header('Content-Type', 'application/json');
        }
    }

    public function user(Request $request)
    {
        $user         = Auth::user();
        $data         = User::where('id',$user->id)->first();
        $appointments = Appoinment::where('id',$user->id)->count();
        $illnessid    = PatientIllnes::where('patient_id',$user->id)->pluck('illness_id');
        $illness      = Illness::whereIn('id',$illnessid)->get();
        $response['status']       = "200";
        $response['data']         = Auth::user();
        $response['illness']      = $illness;
        $response['appointments'] = $appointments;
        return response($response,200)->header('Content-Type', 'application/json');
    }

    public function Update_Profile(Request $request) 
    {
        try {
            $user                     = Auth::user();
            $user->name               = $request->name;
            $user->email              = $request->email;
            $user->address            = $request->address;
            $user->contact            = $request->contact;
            $user->gender             = $request->gender;
            $user->date_of_birth      = $request->date_of_birth;
            $user->emergencey_contact = $request->emergency_contact;

            if($request->medical_record){
                $fileName = time().'.'.$request->medical_record->extension();
                $request->medical_record->move(public_path('document'), $fileName);
                $pdffilename = $fileName;
                $pdfurl   = 'document/'.$fileName;
                $user->medical_record     = $pdffilename;
                $user->medical_record_url = $pdfurl;
            }if($request->image){
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('image/user/' .$filename));
                $url = 'image/user/'.$filename;
                $user->image              = $filename;
                $user->url                = $url;
            }
            if($request->illness_id) {
                $row = PatientIllnes::where('patient_id',$user->id)->delete();
                foreach ($request->illness_id as $illness) {
                    $patientillness = array(
                        'illness_id' => $illness,
                        'patient_id' => $user->id,
                        'status'     => 'Active',
                    );
                    $runs = PatientIllnes::create($patientillness);
                } 
            }
            $run = $user->update();

            if($run){
                return response()->json([
                    'data'    => $user,
                    'status'  => '200',
                    'message' => 'User Record Update Successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function ForgotPassword(Request $request)
    {
        // return $request->all();
        $user = User::where('email',$request->email)->first();
        // return $user;
        $newPass = str::random(8);
        // return $newPass;
        if($user){
            $user->password = Hash::make($newPass);
            $user->update();
            $response['status'] = '200';
            $response['message'] = 'password update succussfully';
            $response['new_password'] = $newPass;
            return response($response, 200)->header('Content-Type', 'application/json');

        }else{

            $response['status'] = '204';
            $response['message'] = 'invalid email';
            return response($response, 200)->header('Content-Type', 'application/json');

        }

    }


    public function Update_Profile_Doctor(Request $request) 
    {
        try {
            $user                     = Auth::user();
            if($user){
                $user->name            = $request->name;
                $user->email           = $request->email;
                $user->address         = $request->address;
                $user->contact         = $request->contact;
                $user->gender          = $request->gender;
                $user->date_of_birth   = $request->date_of_birth;
                $user->description     = $request->description;
                $user->work_experience = $request->work_experience;
                $user->education       = $request->education;
                $user->hospital_name   = $request->hospital_name;
                $user->fees            = $request->fees_amount;

                if($request->medical_record){
                    $fileName = time().'.'.$request->medical_record->extension();
                    $request->medical_record->move(public_path('document'), $fileName);
                    $pdffilename = $fileName;
                    $pdfurl   = 'document/'.$fileName;
                    $user->medical_record     = $pdffilename;
                    $user->medical_record_url = $pdfurl;
                }
                if($request->image){
                    $image       = $request->file('image');
                    $filename    = $image->getClientOriginalName();
                    $image_resize = Image::make($image->getRealPath());              
                    $image_resize->resize(150, 150);
                    $image_resize->save(public_path('image/user/' .$filename));
                    $url = 'image/user/'.$filename;
                    $user->image              = $filename;
                    $user->url                = $url;
                }
                $run = $user->update();
            }

            if($run){
                return response()->json([
                    'data'    => $user,
                    'status'  => '200',
                    'message' => 'Doctor Record Update Successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function Doctor_profile()
    {
        $user                  = Auth::user();
        $data                  = User::with('category:id,name,image,url')->where('id',$user->id)->first();
        $specalityid           = Speciality::where('doctor_id',$user->id)->pluck('subcat_id');
        $specality             = Subcategory::whereIn('id',$specalityid)->get();
        $response['status']    = "200";
        $response['data']      = $data;
        $response['specality'] = $specality;
        return response($response,200)->header('Content-Type', 'application/json');
    }

    public function send_notification(Request $request){
        try{             
            $user = User::where('id',$request->user_id)->first();
            $fcm = $user->fcm_token;
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            if($request->user_type == "patient"){
              $body = "Please join The call. Doctor is waiting";
            }else{
              $body = "Please join The call. Patient is waiting";
            }
            
            $notification = [
                'title' => 'Notification',
                'body'  => $body,
                'type'  => 'test',
            ];
            $fcmNotification = [
                'registration_ids'=>["$fcm"], 
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
            $result = curl_exec($ch); //$result->status='200';
            echo $result;
            curl_close($ch);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
