@extends('layouts.app')

@section ('title')
    Sub Category Update
@endsection

@section ('header')
    Sub Category Update
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="offset-3 col-xl-6 col-lg-6 col-sm-6  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-xl-10 col-lg-10 col-sm-10">
                                    <h3 style="text-align:center;">Sub Category Update Form</h3>
                                </div>
                                
                            </div>


                            <form class="mt-0" method="POST" enctype="multipart/form-data" action="{{route('subcategory.update',$row->id)}}" >
                                {{method_field('PUT')}}
                                {{csrf_field()}}
                                <!-- <div class="form-group" style="text-align:center;">
                                    <img src="{{asset($row->url)}}" alt="" class="img-circle">
                                </div> -->
                                <div class="form-group">
                                    <select name="cat_id" class="form-control" >
                                        <option selected disabled>--Select Category Tag--</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}" {{($cat->id == $row->cat_id)? 'selected' : ''}}>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Image Preview</label>
                                    <div>
                                        <img id="blah" src="{{asset($row->url)}}" style="width:80px; height:80px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="imgInp" name="image">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$row->name}}">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Update</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->

@endsection

   

@section('javascript')
<script>
       imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
</script>


@endsection