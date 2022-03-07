@extends('layouts.app')

@section ('title')
    Category
@endsection

@section ('header')
    Category List
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-xl-10 col-lg-10 col-sm-10">
                                    <h3>Category List</h3>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                                @if(\Laratrust::isAbleTo('category-create'))
                                    <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                      Add Category
                                    </button>
                                @endif
                                </div>
                            </div>
                            
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $key=> $cat)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$cat->name}}</td>
                                            <td><img src="{{asset($cat->url)}}" alt="" class="img-circle"></td>
                                            <td id="{{$cat->id}}">
                                                @if($cat->status == 'Active')
                                                <span class="btn badge badge-info">Active</span>
                                                @else
                                                <span class="btn badge badge-danger">Disabled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group-sm">
                                                @if(\Laratrust::isAbleTo('category-status'))
                                                    @if($cat->status == 'Active')
                                                    <a onclick="StatusUpdate({{$cat->id}})" class="btn btn-warning"><i class="fa fa-ban"></i></a> 
                                                    @else
                                                    <a onclick="StatusUpdate({{$cat->id}})" class="btn btn-success"><i class="fa fa-check"></i></a> 
                                                    @endif
                                                @endif
                                                @if(\Laratrust::isAbleTo('category-update'))
                                                    <a href="{{route('category.edit',$cat->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                                                @endif
                                                @if(\Laratrust::isAbleTo('category-delete'))
                                                    <a href="{{url('categorydel',$cat->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->
        <!-- Modal Start-->
    <div class="modal fade register-modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form class="mt-0" method="POST" id="form" action="{{route('category.store')}}"  enctype="multipart/form-data"  >
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label>Image Preview</label>
                            <div>
                                <img id="blah" src="#" accept="image/*"  style="width:80px; height:80px;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Image <span style="color:red;">*</span></label>
                            <input type="file" class="form-control" id="imgInp" name="image">
                        </div> 
                        <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Ended -->

    
@endsection

    

@section('javascript')

@if($errors->isNotEmpty())
    <script>
        Snackbar.show({
            text           : 'You Enter Wrong Data..!',
            pos: 'top-right',
            actionTextColor: '#fff',
            backgroundColor: '#e7515a'
        });
    </script>
@endif
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
        function StatusUpdate(cat_id){
        $.ajax({ 
            url:'{{url("categroy_status")}}',
            data: {
                "_token"    :"{{csrf_token()}}",
                cat_id:cat_id, 
            },
            type: "POST",
            success: function(data){
                var val = data.status
                var html = '';
                if(val == "Active"){
                    html = "<span class='btn badge badge-info'>Active</span>";
                }else{
                    html = "<span class='btn badge badge-danger'>Disabled</span>";
                }
                document.getElementById(cat_id).innerHTML=html;

                Snackbar.show({
                    text           : 'Status Update Successfully',
                    pos            : 'top-right',
                    backgroundColor: '#1B55E2'
                });
            },

            error: function(error){
                Snackbar.show({
                    text: 'Somthing Went Wrong',
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a'
                });
            }
        });
    }
    </script>

    

    
@endsection