@extends('layouts.app')

@section ('title')
    Doctor Update
@endsection

@section ('header')
    Doctor Update
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
                                <h3>Doctor Update Forrm</h3>
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
                                        <!-- <input type="text" class="form-control" name="gender"  value="{{$doctors->gender}}"> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth"  value="{{$doctors->date_of_birth}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="cat_id" class="form-control" >
                                            <option selected disabled>--Select Categories--</option>
                                            @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}" {{($cat->id == $doctors->cat_id)? 'selected' : ''}}>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Medical Record</label>
                                        <input type="text" class="form-control" name="medical_record"  value="{{$doctors->medical_record}}">
                                    </div>
                                </div> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-block" onclick="UpdateDoctorData()">Update</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a href="{{route('doctor.index')}}" class="btn btn-warning mt-2 mb-2 btn-block">Back</a>
                                    </div>
                                </div>
                            </div>
                            
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
    function UpdateDoctorData()
    {
        //    alert(0);

        //    return false;
        
        var formdata = $('#doctor_data').serialize();
        console.log(formdata);
        //    return false;
        $.ajax({
            type: "POST",
            url : '{{url("doctorupdate_admin")}}',
            data: formdata,
        //    return false,    
            success: function(data){
            //    document.getElementById('name').value=data.name;
                Snackbar.show({
                    text           : 'Doctors Profile Update Successfully',
                    pos            : 'top-right',
                    backgroundColor: '#1B55E2'
                });
            }
        });
    }

    function imageDelete(id)
    {
        // alert(id);
        // return false;
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
</script>

@endsection
