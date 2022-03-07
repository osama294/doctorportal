@extends('layouts.app')

@section ('title')
    Doctor Profile
@endsection

@section ('header')
    Doctor Profile
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
                                <h3>My Profile</h3>
                            </div>
                        </div>
                        <div class="row text-right">
                                <div class="col">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="button" class="btn btn-primary " onclick="UpdateDoctorData()">Update</button>
                                    </div>
                                </div>
                            </div>
                        <form class="mt-0" id="doctor_data" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="hidden" class="form-control" name="id" value="{{$doctors->id}}">
                                        <input type="text" class="form-control" name="name" value="{{$doctors->name}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <input type="text" class="form-control" name="contact"  value="{{$doctors->contact}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"  value="{{$doctors->email}}">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="{{$doctors->gender}}">{{$doctors->gender}}</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth"  value="{{$doctors->date_of_birth}}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <form class="mt-0" method="POST" id="form" action="{{route('doctordetailsupdate',$doctors->id)}}" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-10 col-sm-10">
                                    <h3>Doctor Information</h3>
                                </div>
                                <div class="col-md-2 col-sm-2 text-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>    
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    @if($doctors->image)
                                        <label>Profile Image</label>
                                            <div style="width:50%; height:160px;">
                                                <img src="{{asset($doctors->url)}}" alt="" class="img-circle" id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" style="max-height: 150px;">
                                            </div>
                                            <div class="form-group" style="margin-left:12px;">
                                                <label class="btn btn-primary btn-file">
                                                        <i class="fa fa-edit"></i>
                                                    <input type="file" style="display: none;" name="image" id="image">
                                                </label>
                                                <label class="btn btn-danger">
                                                    <input type="hidden" class="form-control" value="{{$doctors->id}}" id="id">
                                                    <a onclick="imageDelete(document.getElementById('id').value)" style="color:white"><i class="fa fa-trash"></i></a>
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label>Image Preview</label>
                                                <div style="width:50%; height:160px;">
                                                    <img alt="No Image" class="img-circle" id="preview-image-before-upload" style="height:150px;" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="btn btn-sm btn-primary btn-file ">
                                                        Choose Upload Image <i class="fa fa-upload"></i>
                                                    <input type="file" style="display: none;" name="image" id="image">
                                                </label>
                                            </div>
                                    @endif
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Hospital Name</label>
                                                <input type="text" class="form-control" name="hospital_name" value="{{$doctors->hospital_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label>Fees Amount</label>
                                                <input type="number" class="form-control" name="fees_amount" value="{{$doctors->fees}}">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="form-group">
                                                <label>About Doctor</label>
                                                <textarea class="form-control" name="description" rows="3">{{$doctors->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
    <!--  END CONTENT AREA  -->    
@endsection

    

@section('javascript')
<script>
    $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
    });
    function UpdateDoctorData()
    {
        var formdata = $('#doctor_data').serialize();
        console.log(formdata);
        //    return false;
        $.ajax({
            type: "POST",
            url : '{{url("doctorupdate")}}',
            data: formdata,
        //    return false,    
            success: function(data){
            //    document.getElementById('name').value=data.name;
                Snackbar.show({
                    text           : 'Doctors Update Successfully',
                    pos            : 'top-right',
                    backgroundColor: '#1B55E2'
                });
            }
        });
    }

    function imageDelete(id)
    {
        $.ajax({
            type : "POST",
            // url  : "illnesupdate/"+id,
            url:'{{url("imagedelete")}}/'+id,
            data : {
                "_token"    :"{{csrf_token()}}",
                'id' : id,
                // 'name' : name,
            },      
            success: function(data){
                // document.getElementById('name').value=data.name;
                Snackbar.show({
                    text: 'Image Delete Successfully',
                    pos: 'top-right',
                    backgroundColor: '#1B55E2'
                });
                setTimeout(() => {
                    
                window.location.reload();
                }, 1000);
            }
        });
    }
</script>

@endsection
