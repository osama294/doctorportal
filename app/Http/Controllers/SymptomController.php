<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return view('admin.symptom.index', compact('symptoms'));
    }

    public function getSymptom(Request $request)
    {
        if ($request->ajax()) {
            $data = Symptom::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn ="<div class='btn-group-sm'>
                                    <a href='symptomdel/$row->id'  class='btn btn-danger'>
                                        <i class='fa fa-trash'></i>
                                    </a>
                                    <a href='symptom/$row->id/edit' class='btn btn-primary'>
                                        <i class='fa fa-edit'></i>
                                    </a>
                                </div>";
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $actionBtn ="<span class='badge badge-info'>$row->status</span>";
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
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
        try {
            $rule = array(
                'name'  => 'required|unique:symptoms',
            );
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $row            = new Symptom();
            $row->name      = $request->name;
            $row->status    = 'Active';
            $run = $row->save();

            if ($run) {
                return redirect()->route('symptom.index')->with('success','Symptom Add Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "Pak";
        $row = Symptom::find($id);
        return view('admin.symptom.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        //
    }


    public function Symptom_Update(Request $request, $id){
        // return $request->all();
        $row       =Symptom::find($id);
        $row->name = $request->name;
        $run       = $row->update();
        if ($run) {
            return $row;
            // return redirect()->route('illnes.index')->with('success','Illness Update Succesfully');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Symptom::find($id);
        $run = $row->delete();
        if ($run){
            return redirect()->route('symptom.index')->with('msg','Symptom Delete Succesfully');
        }
    }

    public function ChangeStatus(Request $request)
    {
        $row = Symptom::where('id',$request->symptom_id)->first();
        if($row->status == 'Active')
        {
            $row->status = 'Disabled';
        }else{
            $row->status = 'Active';
        }
        $run = $row->update();
        if($run){
            return $rows = Symptom::where('id',$request->symptom_id)->first();
        }
    }

    
}
