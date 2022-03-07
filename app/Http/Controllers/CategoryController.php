<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
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
                'name'  => 'required|unique:categories',
            );
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            // $request->validate([
            //     'name' => 'required|unique:categories',
            // ]);
            
            // $validator = \Validator::make($request->all(), [
            //     'name' => 'required|unique:categories',
            // ]);

            // if ($validator->fails())
            // {
            //     return response()->json(['errors'=>$validator->errors()->all()]);
            // }
            // return $request->all();


            $item = array(
                'name'   => $request->name,
                'status' => 'Active',
            );

            $image        = $request->file('image');
            $extension    = $image->getClientOriginalExtension();
            $filename     = time() . '.'.$extension;
            $image_resize = \Image::make($image->getRealPath());
            $image_resize->resize(50,50);
            $image_resize->save(public_path('image/category/'.$filename));
            $url = '/image/category/'.$filename;

            $item['image'] = $filename;
            $item['url']   = $url;
            $insert  = Category::create($item);
    
            if ($insert) {
                return redirect()->route('category.index')->with('success','Category Add Succesfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "Pak";
        $row = Category::find($id);
        return view('admin.category.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try{
            if($request->hasFile('image')) { 
                    $image       = $request->file('image');
                    $filename    = $image->getClientOriginalName();
                    $image_resize = Image::make($image->getRealPath());              
                    $image_resize->resize(50,50);
                    $image_resize->save(public_path('image/category/' .$filename));
                    // $data['company_logo'] = $filename;
                    $url = '/image/category/'.$filename;

                    $deal                  = Category::find($id);
                    $deal->image           = $filename;
                    $deal->url             = $url;
                    $deal->name            = $request->name;
            }else{
                    $deal                     = Category::find($id);
                    $deal->name            = $request->name;
            }
            $up = $deal->update();

            if ($up){
                return redirect()->route('category.index')->with('success','Category Update Successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

 
    public function destroy($id)
    {
        $row = Category::find($id);
        $run = $row->delete();
        if ($run){
            return redirect()->route('category.index')->with('success','Category Delete Succesfully');
        }
    }


    public function ChangeStatus(Request $request)
    {
        $row = Category::where('id',$request->cat_id)->first();
        if($row->status == 'Active')
        {
            $row->status = 'Disabled';
        }else{
            $row->status = 'Active';
        }
        $run = $row->update();
        if($run){
            return $rows = Category::where('id',$request->cat_id)->first();
        }
    }
}
