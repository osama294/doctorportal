@extends('layouts.app')

@section ('title')
    Doctors
@endsection

@section ('header')
    Doctors List
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
                                <h3>Doctors List</h3>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                            @if(\Laratrust::isAbleTo('doctor-create'))
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Doctor
                                </button>
                            @endif
                            </div>
                        </div>
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Gender</th>
                                        <!-- <th>Date Of Birth</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($doctors as $key=> $doctor)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                        {{ $doctor->category ? $doctor->category->name : 'Assign Category'  }}
                                        </td>
                                        <td>{{$doctor->name}}</td>
                                        <td>{{$doctor->email}}</td>
                                        <td>{{$doctor->contact}}</td>
                                        <td>{{$doctor->gender}}</td>
                                        <!-- <td>{{$doctor->date_of_birth}}</td> -->
                                        <td id="{{$doctor->id}}">
                                            @if($doctor->status == 'Active')
                                            <span class="btn badge badge-info">{{$doctor->status}}</span>
                                            @else
                                            <span class="btn badge badge-danger">{{$doctor->status}}</span>
                                            @endif    
                                        </td>
                                        <td>
                                            <div class="btn-group-sm">
                                                @if(\Laratrust::isAbleTo('doctor-status'))
                                                <span id="{{$doctor->id}}btn" class="btn-group-sm">
                                                    @if($doctor->status == 'Active')
                                                    <a onclick="StatusUpdate({{$doctor->id}})" class="btn btn-warning"><i class="fa fa-ban"></i></a> 
                                                    @else
                                                    <a onclick="StatusUpdate({{$doctor->id}})" class="btn btn-success"><i class="fa fa-check"></i></a> 
                                                    @endif
                                                </span>
                                                @endif
                                                @if(\Laratrust::isAbleTo('doctor-update'))
                                                    <a href="{{route('doctor.edit',$doctor->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if(\Laratrust::isAbleTo('doctor-delete'))
                                                    <a href="{{url('userdel',$doctor->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                @endif
                                                @if(\Laratrust::isAbleTo('doctor-view'))
                                                    <button onclick="doctorProfile({{$doctor->id}})"  class="btn btn-success"><i class="fas fa-eye"></i></button>
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
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" id="registerModalLabel">
            <h4 class="modal-title">Add Doctor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form class="mt-0" method="POST" id="form" action="{{route('doctor.store')}}">
                {{csrf_field()}}
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="number" class="form-control" name="contact" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required >
                                <option selected disabled>--Select Gender--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Medical Record</label>
                            <input type="text" class="form-control" name="medical_record">
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Category</label>
                            <select name="cat_id" class="form-control" required>
                                <option selected disabled>--Select Categories--</option>
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Types</label>
                            <select name="type" id="" class="form-control">
                                <option value="0" selected="" disabeled>Please Select Type</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Patient">Patient</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Save</button>
                        </div>
                    </div>
                </div>
                    
                </form>
            </div>
            <!-- <div class="modal-footer justify-content-center">
            
            </div> -->
        </div>
        </div>
    </div>
    <!-- Model Ended -->
    <!-- Modal -->
    
    <div class="modal fade " id="doctorProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl zoomInUp" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Doctor Profile Details</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col ">
                            <div class="card component-card_1">
                                <div class="card-body text-center">
                                    <img src="" class=" mb-4" id ="docImage"alt="No doctor Image found" width="200px" height="200px">
                                    <h5 class="card-text">Ratings 
                                        <span class="card-text" id="docStar">
                                            <span id="star1" class="fa fa-star checked"></span>
                                            <span id="star2" class="fa fa-star"></span>
                                            <span id="star3" class="fa fa-star "></span>
                                            <span id="star4" class="fa fa-star"></span>
                                            <span id="star5"class="fa fa-star"></span>
                                        </span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card component-card_1">
                                <div class="card-body">
                                <!-- <i class="fas fa-dollar-sign"></i> -->
                                    <h5 class="card-title"><i class="fas fa-user-md"></i>&nbsp;&nbsp; Dr. <span id="docName"></span> | <span id="docCatName"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp; <span id="docFees"></span> </h5>
                                    <h5 class="card-title"><i class="fab fa-pagelines"></i>&nbsp;&nbsp; <span id ="docAge"> </span>&nbsp Years </h5>
                                    <h5 class="card-title"><i class="fas fa-envelope"></i>&nbsp;&nbsp; <span id ="docEmail"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-phone-square-alt"></i>&nbsp;&nbsp;  <span id="docContact"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp; <span id="docWorksAt"></span></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-address-card"></i>&nbsp;&nbsp; <span id="docAddress"></span></h5> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button> -->
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


    

@section('javascript')
<script>
    function doctorProfile(doctor_id){
        $.ajax({ 
            url:'{{url("doctor_details")}}',
            data:    {
                "_token"    :"{{csrf_token()}}",
                docID:doctor_id, 
            },
            type: "POST",
            success: function(data){ 
                $("#doctorProfile").modal('show');
                $("#docName").html(data.Profile['name']); 
                $("#docEmail").html(data.Profile['email']); 
                $("#docContact").html(data.Profile['contact']); 
                $("#docAge").html(data['age']); 
                $("#docAddress").html(data.Profile['address']); 
                $("#docDesc").html(data.Profile['description']);
                $("#docWorksAt").html(data.Profile['hospital_name']); 
                $("#docFees").html(data.Profile['fees']); 
                $("#docStatus").html(data.Profile['status']);
                if(data.Profile.category['name'] ){
                $("#docCatName").html(data.Profile.category['name']); 
                document.getElementById('docImage').src = data.Profile['url'];
                }
                
                if(data.star >= 1 && data.star <=20 ){
                    document.getElementById('star1').style.background ='yellow';
                }else if(data.star >= 21 && data.star <=40){
                    document.getElementById('star2').style.background ='yellow';
                }else if(data.star >= 41 && data.star <=60){
                    document.getElementById('star3').style.background ='yellow';
                }else if(data.star >= 61 && data.star <=80){
                    document.getElementById('star4').style.background ='yellow';
                }else if(data.star >= 81 && data.star <=100){
                    document.getElementById("star5").style.background ='yellow';
                    document.getElementById("star4").style.background ='yellow';
                    document.getElementById("star3").style.background ='yellow';
                    document.getElementById("star2").style.background ='yellow';
                    document.getElementById("star1").style.background ='yellow';
                }else{
                    console.log('0 star for doctor');
                }
            },
            error: function(error){
               alert('Error Found!');
            }
        });
    }

    
</script>
<script>
    function StatusUpdate(id){
        // alert(id);
        $.ajax({ 
            url:'{{url("user_status")}}',
            data: {
                "_token"    :"{{csrf_token()}}",
                id:id, 
            },
            type: "POST",
            success: function(data){
                var val = data.status
                var val2 = data.id
                var html = '';
                var html2 = '';
                var name = '';
                console.log(val2); 
                if(val == "Active"){
                    html = "<span class='btn badge badge-info'>Active</span>";
                    html2 = `<a onclick='StatusUpdate(${val2})' class='btn btn-warning'><i class='fa fa-ban'></i></a>`;
                }else{
                    html = "<span class='btn badge badge-danger'>Disabled</span>";
                    html2 = `<a onclick='StatusUpdate(${val2})' class='btn btn-success'><i class='fa fa-check'></i></a>`;
                }

                document.getElementById(id).innerHTML=html;
                document.getElementById(id+'btn').innerHTML=html2; 
                
                Snackbar.show({
                    text           : 'Status Update Successfully',
                    pos            : 'top-right',
                    backgroundColor: '#1B55E2'
                });
                // setTimeout(() => {
                    
                // window.location.reload();
                // }, 300);
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