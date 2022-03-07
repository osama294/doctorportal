@extends('layouts.app')

@section ('title')
Appointment
@endsection

@section ('header')
Appointment List
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
                            <h3>Appointment List</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="zero-config" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doctor Name</th>
                                    <th>Patient Name</th>
                                    <th>Complaint</th>
                                    <th>Start Date</th>
                                    <th>Description</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($appoinments as $key=> $app)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$app->doctor->name}}</td>
                                    <td>{{$app->patient->name}}</td>
                                    <td>{{$app->complaint_name}}</td>
                                    <td>{{$app->starting_date}}</td>
                                    <td>{{$app->description}}</td>
                                    <!-- <td class=""><span class="badge badge-info">{{$app->status}}</span></td> -->
                                    <td>
                                        <div class="btn-group-sm">
                                        @if(\Laratrust::isAbleTo('symptoms-create'))
                                            <button onclick="PateintAppoinment({{$app->patient->id}},{{$app->doctor->id}},{{$app->id}})"  class="btn btn-primary"><i class="fas fa-eye"></i></button>
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
                                <h6 class="card-text">Patient Profille Image</h6>
                                <img src="" class="mb-4" id ="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card component-card_1">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Name:</strong>  <span id="name"></span> </h5>
                                <h5 class="card-title"><strong>Email:</strong> <span id="email"></span> </h5>
                                <h5 class="card-title"><strong>Contact:</strong> <span id ="contact"> </span> </h5>
                                <h5 class="card-title"><strong>Gender:</strong> <span id ="gender"></span> </h5>
                                <h5 class="card-title"><strong>Address:</strong> <span id="address"></span> </h5>
                                <!-- <h5 class="card-title"><strong>Date Of birth:</strong> <span id="date_of_birth"></span></span> </h5> -->
                                <!-- <h5 class="card-title"><strong>Emergencey Contact:</strong> <span id="emergencey_contact"></span></h5>  -->
                            </div>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-9">
                        <div class="card component-card_1">
                            <div class="card-body">
                                    <h2 class="text-center">Appointment Details</h6>
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
            </div>
            <div class="modal-footer">
                <!-- <button type="button" data-dismiss="modal" class="btn btn-primary">Show Details</button> -->
                <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')

<script>
    function PateintAppoinment(patientid,doctorid,appoinmentid){
        // alert(patientid);
        $.ajax({ 
            url:'{{url("patient_appoinment_details")}}',
            data:    {
                "_token"    :"{{csrf_token()}}",
                patientid:patientid, 
                doctorid:doctorid, 
                appoinmentid:appoinmentid, 
            },
            type: "POST",
            success: function(data){

                var htm = '<h6 class="text-center">Patient Symptoms </h6>'; 
                var counter = 1;
                for(let i=0;i<data.symptom.length;i++){
                    
                    htm +=`<h5 class="card-title"><strong>`+counter+`</strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong>`+data.symptom[i].name+`</strong></h5>`;
                    counter++;
                }

                document.getElementById('symptoms').innerHTML = htm;

                // console.log(data.patient.name);
                // return false;
                // Pateint Details Starts
                $("#PatientProfileModel").modal('show');
                $("#name").html(data.patient.name); 
                $("#email").html(data.patient.email); 
                $("#contact").html(data.patient.contact); 
                $("#gender").html(data.patient.gender); 
                $("#address").html(data.patient.address); 
                $("#date_of_birth").html(data.patient.date_of_birth);
                $("#emergencey_contact").html(data.patient.emergencey_contact); 
                document.getElementById('image').src = data.patient.url;
                // Appoinment Details Starts
                $("#smoke").html(data.appoinment.smoke); 
                $("#diabetes").html(data.appoinment.diabetes); 
                $("#asthma").html(data.appoinment.asthma); 
                $("#allergic").html(data.appoinment.allergic); 
                $("#diagnosed_diabetes").html(data.appoinment.diagnosed_diabetes); 
                $("#diagnosed_heart").html(data.appoinment.diagnosed_heart);
                $("#diagnosed_kidney").html(data.appoinment.diagnosed_kidney); 
                $("#diagnosed_arthritis").html(data.appoinment.diagnosed_arthritis); 
                $("#diagnosed_pulmonary").html(data.appoinment.diagnosed_pulmonary); 
                $("#diagnosed_eating").html(data.appoinment.diagnosed_eating); 

                // if(data.symptom){
                    
                // }
            },
            error: function(error){
               alert('Error Found!');
            }
        });
    }
</script>

@endsection
    
