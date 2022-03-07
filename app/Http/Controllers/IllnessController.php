<?php

namespace App\Http\Controllers;

use App\Models\Illness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IllnessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ilness = Illness::all();
        return view('admin.illness.index', compact('ilness'));
    }

    public function Illness_Test()
    {
        $ilness = Illness::all();
        return view('admin.illness.test', compact('ilness'));
    }

    public function GetData(Request $request)
    {
        return $ilness = Illness::select('id','name','status')->get();
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
        try {
            $rule = array(
                'name'  => 'required|unique:illnesses',
            );
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $row            = new Illness();
            $row->name      = $request->name;
            $row->status    = 'Active';
            $run = $row->save();

            if ($run) {
                return redirect()->route('illnes.index')->with('success','Illness Add Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Illness_insert(Request $request)
    {
        try {
            // $rule = array(
            //     'name'  => 'required|unique:illnesses',
            // );
            // $validator = Validator::make($request->all(),$rule);
            // if($validator->fails())
            // {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }
            $row            = new Illness();
            $row->name      = $request->name;
            $row->status    = 'Active';
            $run = $row->save();

            if ($run) {
                return  $ilness = Illness::all();
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Illness  $illness
     * @return \Illuminate\Http\Response
     */
    public function show(Illness $illness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Illness  $illness
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
            // return "Pak";
            $row = Illness::find($id);
            return view('admin.illness.edit', compact('row'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Illness  $illness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
        try {

            $row       =Illness::find($id);
            $row->name = $request->name;
            $run       = $row->update();

            if ($run) {
                return redirect()->route('illnes.index')->with('success','Illness Update Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Illnes_Update(Request $request, $id){
        $row       =Illness::find($id);
        $row->name = $request->name;
        $run       = $row->update();
        if ($run) {
            return $row;
        }
    }

    public function Illness_Model(Request $request){
        $row       =Illness::where('id',$request->id)->first();
        if ($row) {
            return $row;
        }
    }

    public function Illnes_Update_Data(Request $request){
        $row       =Illness::where('id',$request->id)->first();
        $row->name = $request->name;
        $run       = $row->update();
        if ($run) {
            return $row;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Illness  $illness
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
        
    //     $row = Illness::find($id);
    //     $run = $row->delete();
    //     if ($run){
    //         return redirect()->route('illnes.index')->with('success','Illness Delete Succesfully');
    //     }
    // }


    public function destroy($id)
    {
        $row = Illness::find($id);
        $run = $row->delete();
        if ($run){
            return "Success";
        }
    }

    public function ChangeStatus(Request $request)
    {
         $row = Illness::where('id',$request->illness_id)->first();
        if($row->status == 'Active')
        {
            $row->status = 'Disabled';
        }else{
            $row->status = 'Active';
        }
        $run = $row->update();
        if($run){
            return $rows = Illness::where('id',$request->illness_id)->first();
        }
    }
}
