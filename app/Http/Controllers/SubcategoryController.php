<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //subcategory
        $categories = Category::all();
        $subcategories = Subcategory::with('category')->get();
        // return $subcategories;
        return view('admin.sub_category.index', compact('categories','subcategories'));
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
        // return $request->all();
        try {
            $rule = array(
                'name'  => 'required|unique:subcategories',
            );
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $item = array(
                'name'   => $request->name,
                'cat_id' => $request->cat_id,
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
            $insert  = Subcategory::create($item);

            // $row            = new Subcategory();
            // $row->cat_id      = $request->cat_id;
            // $row->name      = $request->name;
            // $row->status    = 'Active';
            // $run = $row->save();

            if ($insert) {
                return redirect()->route('subcategory.index')->with('success','Sub Category Add Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $row        = Subcategory::find($id);

        return view('admin.sub_category.edit', compact('categories','row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //  return $request->all();
         try {

            if($request->hasFile('image')) { 
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(50,50);
                $image_resize->save(public_path('image/category/' .$filename));
                // $data['company_logo'] = $filename;
                $url = '/image/category/'.$filename;

                $deal         = Subcategory::find($id);
                $deal->cat_id = $request->cat_id;
                $deal->image  = $filename;
                $deal->url    = $url;
                $deal->name   = $request->name;
        }else{
                $deal         = Subcategory::find($id);
                $deal->cat_id = $request->cat_id;
                $deal->name   = $request->name;
        }
                $up = $deal->update();

            // $row            = Subcategory::find($id);
            // $row->cat_id      = $request->cat_id;
            // $row->name      = $request->name;
            // $run = $row->update();

            if ($up) {
                return redirect()->route('subcategory.index')->with('success','Sub Category Update Succesfully');
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Subcategory::find($id);
        $run = $row->delete();
        if ($run){
            return redirect()->route('subcategory.index')->with('success','Sub Category Delete Succesfully');
        }
    }


    public function ChangeStatus(Request $request)
    {
        $row = Subcategory::where('id',$request->subcat_id)->first();
        if($row->status == 'Active')
        {
            $row->status = 'Disabled';
        }else{
            $row->status = 'Active';
        }
        $run = $row->update();
        if($run){
            return $rows = Subcategory::where('id',$request->subcat_id)->first();
        }
    }
}
