@extends('layouts.app')

@section ('title')
    Patient
@endsection

@section ('header')
    Patient List
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
                                <h3>Patient List</h3>
                            </div>
                        </div>
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($patients as $key=> $patient)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$patient->name}}</td>
                                        <td>{{$patient->email}}</td>
                                        <td>{{$patient->contact}}</td>
                                        <td>{{$patient->gender}}</td>
                                        <td>{{$patient->date_of_birth}}</td>
                                        <td id="{{$patient->id}}">
                                            @if($patient->status == 'Active')
                                            <span class="btn badge badge-info">{{$patient->status}}</span>
                                            @else
                                            <span class="btn badge badge-danger">{{$patient->status}}</span>
                                            @endif    
                                        </td>
                                        <td>
                                            <div class="btn-group-sm">
                                            @if(\Laratrust::isAbleTo('patient-status'))
                                                <span id="{{$patient->id}}btn" class="btn-group-sm">
                                                    @if($patient->status == 'Active')
                                                    <a onclick="StatusUpdate({{$patient->id}})" class="btn btn-warning"><i class="fa fa-ban"></i></a> 
                                                    @else
                                                    <a onclick="StatusUpdate({{$patient->id}})" class="btn btn-success"><i class="fa fa-check"></i></a> 
                                                    @endif
                                                </span>
                                            @endif
                                            @if(\Laratrust::isAbleTo('patient-view'))
                                                <button onclick="PateintProfile({{$patient->id}})"  class="btn btn-success"><i class="fas fa-eye"></i></button>
                                            @endif
                                            
                                                <button onclick="PateintAppoinment({{$patient->id}})"  class="btn btn-primary"><i class="fas fa-clock"></i></button>
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


    <!-- MOdel Area -->
    <div class="modal fade " id="PatientProfileModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl zoomInUp" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Patient Profile Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card component-card_1">
                                <div class="card-body text-center">
                                    <h6 class="card-text">Pateint Profille Image</h6>
                                    <img src="" class="mb-4" id ="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card component-card_1">
                                <div class="card-body text-center">
                                    <h6 class="card-text">Pateint Medical Records</h6>
                                        <img src="" class="mb-4" id ="noImage">
                                        <iframe frameborder="0" style="width:100%;" id="pdf_src"></iframe>
                                        <a class="btn btn-primary" target="_blank" id="pdf_href">Click To Show Record</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card component-card_1">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user"></i>&nbsp;&nbsp; <strong>Name:</strong>  <span id="name"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-envelope"></i>&nbsp;&nbsp; <strong>Email:</strong> <span id="email"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-phone-square-alt"></i>&nbsp;&nbsp; <strong>Contact:</strong> <span id ="contact"> </span> </h5>
                                    <h5 class="card-title"><i class="fas fa-male"></i>&nbsp;&nbsp;&nbsp;&nbsp; <strong>Gender:</strong> <span id ="gender"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-address-card"></i>&nbsp;&nbsp; <strong>Address:</strong> <span id="address"></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-hospital-user"></i>&nbsp;&nbsp; <strong>Date Of birth:</strong> <span id="date_of_birth"></span></span> </h5>
                                    <h5 class="card-title"><i class="fas fa-first-aid"></i>&nbsp;&nbsp; <strong>Emergencey Contact:</strong> <span id="emergencey_contact"></span></h5> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-4">
                            <div class="card component-card_1">
                                <div class="card-body text-center">
                                    <h6 class="">Pateint Illness</h6>
                                        <table class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody id="illness">
                                            
                                            </tbody>
                                        
                                        </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card component-card_1">
                                <div class="card-body text-center">
                                    <h6 class="">Pateint Review</h6>
                                        <table class="table table-hover" id="zero-config2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Review</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="review">
                                               
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" data-dismiss="modal" class="btn btn-primary">Sow Details</button> -->
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Area -->

    <!-- MOdel Area -->
    <div class="modal fade " id="PatientAppoinmentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl zoomInUp" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Patient Latest Appointment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="card component-card_1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <table class="table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Smoke</th>
                                                        <td><span class="badge badge-primary text-center" id="smoke"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Diabetes</th>
                                                        <th><span class="badge badge-primary" id="diabetes"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Asthama</th>
                                                        <th><span class="badge badge-primary" id="asthma"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Alergic</th>
                                                        <th><span class="badge badge-primary" id="allergic"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Diagnosed Diabetes</th>
                                                        <th><span class="badge badge-primary" id="diagnosed_diabetes"></span></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Diagnosed Heart</th>
                                                        <td><span class="badge badge-primary text-center" id="diagnosed_heart"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Diagnosed Kidney</th>
                                                        <th><span class="badge badge-primary" id="diagnosed_kidney"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Diagnosed Arthiritis</th>
                                                        <th><span class="badge badge-primary" id="diagnosed_arthritis"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Diagnosed pulmonary</th>
                                                        <th><span class="badge badge-primary" id="diagnosed_pulmonary"></span></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Diagnosed eating</th>
                                                        <th><span class="badge badge-primary" id="diagnosed_eating"></span></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card component-card_1">
                                <div class="card-body" id="symptoms">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- <h6 class="text-center">Patient Symptoms </h6> -->
                            <div class="card component-card_1">
                                <div class="card-body">
                                    <h6>Details</h6>
                                    <table class="table" style="width:100%">
                                        <!-- <h5>Time Slots</h5> -->
                                        <thead>
                                            <tr>
                                                <th>Doctor Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><span id="doctorname"></span></td>
                                            <td><span id="start_time"></span></td>
                                            <td><span id="end_time"></span></td>
                                            <td><span id="date"></span></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Area -->
@endsection

    

@section('javascript')

<script>

    function PateintProfile(id){
        // alert(id);
        $.ajax({ 
            url:'{{url("patient_details")}}',
            data:    {
                "_token"    :"{{csrf_token()}}",
                id:id, 
            },
            type: "POST",
            success: function(data){
                
                // console.log(data.personal);
                // console.log(data.illness);
                // console.log(data.review);
                // return false;
                $("#PatientProfileModel").modal('show');
                $("#name").html(data.personal.name); 
                $("#email").html(data.personal.email); 
                $("#contact").html(data.personal.contact); 
                $("#gender").html(data.personal.gender); 
                $("#address").html(data.personal.address); 
                $("#date_of_birth").html(data.personal.date_of_birth);
                $("#emergencey_contact").html(data.personal.emergencey_contact); 
                // $("#image").html(data.personal.url);
                // console.log(data.personal.url);
                document.getElementById('image').src = data.personal.url;
                if(data.personal.medical_record_url){
                    document.getElementById('noImage').style.display = "none";
                    document.getElementById('pdf_href').style.display = "block";
                    document.getElementById('pdf_src').style.display = "block";
                    document.getElementById('pdf_src').src = data.personal.medical_record_url;
                    document.getElementById('pdf_href').href = data.personal.medical_record_url;
                }else{
                    document.getElementById('noImage').style.display = "block";
                    document.getElementById('noImage').src = "{{asset('image/no.jpg')}}";
                    document.getElementById('pdf_src').style.display = "none";
                    document.getElementById('pdf_href').style.display = "none";
            

                }

                // patient Illness
                var htm = ''; 
                var counter = 1;
                for(let i=0; i < data.illness.length; i++ ){
                    htm +=`<tr>`+`<td>`+counter+`</td>`+`<td>`+data.illness[i].name+`</td>`+`</tr>`;
                    counter++;
                }
                document.getElementById('illness').innerHTML = htm;
                
                // Patient Review
                var html = ''; 
                var sno = 1;
                for(let i=0; i < data.review.length; i++ ){
                    
                    html+=`<tr>`+`<td>`+sno+`</td>`+`<td>`+data.review[i].userdoctor.name+`</td>`+`<td>`+data.review[i].description+`</td>`+`<td>`+data.review[i].created_at+`</td>`+`</tr>`;
                    sno++;
                }
                document.getElementById('review').innerHTML = html;

            },
            error: function(error){
               alert('Error Found!');
            }
        });
    }
    function PateintAppoinment(id){
        // alert(id);
        $.ajax({ 
            url:'{{url("patient_appoinment")}}',
            data:    {
                "_token"    :"{{csrf_token()}}",
                id:id, 
            },
            type: "POST",
            success: function(data){
                if(data == 'No Data'){
                        Snackbar.show({
                        text: 'No Appoinment Available',
                        pos: 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }else{
                    $("#PatientAppoinmentModel").modal('show');
                    $("#smoke").html(data.smoke); 
                    $("#diabetes").html(data.diabetes); 
                    $("#asthma").html(data.asthma); 
                    $("#allergic").html(data.allergic); 
                    $("#diagnosed_diabetes").html(data.diagnosed_diabetes); 
                    $("#diagnosed_heart").html(data.diagnosed_heart);
                    $("#diagnosed_kidney").html(data.diagnosed_kidney); 
                    $("#diagnosed_arthritis").html(data.diagnosed_arthritis); 
                    $("#diagnosed_pulmonary").html(data.diagnosed_pulmonary); 
                    $("#diagnosed_eating").html(data.diagnosed_eating);

                    var htm = '<h6 class="text-center">Patient Symptoms </h6>'; 
                    var counter = 1;
                    for(let i=0;i<data.patientsymptom.length;i++){
                        
                        htm +=`<h5 class="card-title"><strong>`+counter+`</strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong>`+data.patientsymptom[i].symptom.name+`</strong></h5>`;
                        counter++;
                    }
                    document.getElementById('symptoms').innerHTML = htm;
                    
                    $("#doctorname").html(data.doctor.name); 
                    $("#end_time").html(data.slot.end_time); 
                    $("#start_time").html(data.slot.start_time); 
                    $("#date").html(data.slot.date);

                }

                     
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

<script>
    function StatusUpdate(id){
        $.ajax({ 
            url:'{{url("user_status")}}',
            data: {
                "_token"    :"{{csrf_token()}}",
                id:id, 
            },
            type: "POST",
            success: function(data){
                var val = data.status;
                var id = data.id;
                var html = '';
                var html2 = '';
                if(val == "Active"){
                    html = "<span class='btn badge badge-info'>Active</span>";
                    html2 = `<a onclick='StatusUpdate(${id})' class='btn btn-warning'><i class='fa fa-ban'></i></a>`;
                }else{
                    html = "<span class='btn badge badge-danger'>Disabled</span>";
                    html2 = `<a onclick='StatusUpdate(${id})' class='btn btn-success'><i class='fa fa-check'></i></a>`;

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