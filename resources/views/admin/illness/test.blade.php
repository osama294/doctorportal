@extends('layouts.app')

@section ('title')
    Illness
@endsection


@section ('header')
    Illness List
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
                                <h3>Illness Test List</h3>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Illness
                                </button>
                            </div>
                        </div>
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tabledata">
                                <!-- @foreach ($ilness as $key=> $ill)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$ill->name}}</td>
                                        <td id="{{$ill->id}}">
                                            @if($ill->status == 'Active')
                                            <span class="btn badge badge-info">{{$ill->status}}</span>
                                            @else
                                            <span class="btn badge badge-danger">{{$ill->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group-sm">
                                                @if($ill->status == 'Active')
                                                <a onclick="StatusUpdate({{$ill->id}})" class="btn btn-warning"><i class="fa fa-ban"></i></a> 
                                                @else
                                                <a onclick="StatusUpdate({{$ill->id}})" class="btn btn-success"><i class="fa fa-check"></i></a> 
                                                @endif
                                                <a href="{{route('illnes.edit',$ill->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a onclick="IllnessModel({{$ill->id}})" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                
                                                <a href="{{url('ilnesdel',$ill->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                <a onclick="DeleteData({{$ill->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach -->
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
                    <h4 class="modal-title">Add Illness</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form class="mt-0" method="POST" id="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name : <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <button type="button" onclick="Insertion()" class="btn btn-primary mt-2 mb-2 btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Ended -->

    <!-- MOdel Area -->
    <div class="modal fade " id="IllnessUpdateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog zoomInUp" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Illness Update Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form class="mt-0" method="POST" id="form_update">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name : <span style="color:red;">*</span></label>
                            <input type="text" id="illname" class="form-control" name="name">
                            <input type="hidden" id="illid" class="form-control" name="id">
                        </div>
                        <button type="button" onclick="UpdateIllness()" class="btn btn-primary mt-2 mb-2 btn-block">Save</button>
                    </form>
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
       
        function StatusUpdate(illness_id){
            $.ajax({ 
                url:'{{url("illness_status")}}',
                data: {
                    "_token"    :"{{csrf_token()}}",
                    illness_id:illness_id, 
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
                    GetData();
                    // document.getElementById(illness_id).innerHTML=html;

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

        function Insertion()
        {
            var formdata = $('#form').serialize();
            $.ajax({
                type: "POST",
                url : '{{url("testinsert")}}',
                data: formdata,
                success: function(data){
                     var ResultString = "";
                        $.each(data, function (i, e) {
                            var val2 = e.id;
                            ResultString += '<tr>' +
                            '<td>' + (i+1) + '</td>' +
                            '<td>' + e.name + '</td>' +
                            '<td>';
                            if (e.status == "Active") {
                            ResultString += '<span class="btn badge badge-info">' +e.status+ '</span>'
                            } else {
                            ResultString += '<span class="btn badge badge-danger">' +e.status+ '</span>'
                            }
                            ResultString += '</td>' +
                            '<td>'+'<div class="btn-group-sm">'+
                                    '<a href="illnes/'+e.id+'/edit" class="btn btn-primary">'+'<i class="fa fa-edit">'+'</i>'+'</a>'+
                                    '<a href="ilnesdel/'+e.id+'" class="btn btn-danger">'+'<i class="fa fa-trash">'+'</i>'+'</a>';
                            if (e.status == "Active") {
                                ResultString += `<a onclick='StatusUpdate(${val2})' class='btn btn-warning'><i class='fa fa-ban'></i></a>`;
                                } else {
                                ResultString += `<a onclick='StatusUpdate(${val2})' class='btn btn-success'><i class='fa fa-check'></i></a>`;
                            }
                                '</div>'+'</td>' +
                            
                            '</tr>';
                        });
                        document.querySelector('#tabledata').innerHTML=ResultString; 


                        Snackbar.show({
                            text           : 'Illness Insert Successfully',
                            pos            : 'top-right',
                            backgroundColor: '#1B55E2'
                        });

                        document.getElementById('name').value = '';
                }
            });
        }

        function IllnessModel(id){
            $.ajax({ 
                url:'{{url("illness_model_show_data")}}',
                data:    {
                    "_token"    :"{{csrf_token()}}",
                    id:id, 
                },
                type: "POST",
                success: function(data){
                        $("#IllnessUpdateModel").modal('show');
                        $("#illname").val(data.name); 
                        $("#illid").val(data.id); 
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

        function UpdateIllness(){
            var formdata = $('#form_update').serialize();
            $.ajax({
                type : "POST",
                url:'{{url("illnesupdatemodel")}}',
                data: formdata,      
                success: function(data){
                    Snackbar.show({
                        text: 'Illness Update Successfully',
                        pos: 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                    GetData();
                }
            });
        }

        function GetData(){
            $.ajax({
                type: "GET",
                url : '{{url("testgetdata")}}',
                success: function(data){
                     var ResultString = "";
                        $.each(data, function (i, e) {
                            var val2 = e.id;
                            ResultString += '<tr>' +
                            '<td>' + (i+1) + '</td>' +
                            '<td>' + e.name + '</td>' +
                            '<td>';
                            if (e.status == "Active") {
                            ResultString += '<span class="btn badge badge-info">' +e.status+ '</span>'
                            } else {
                            ResultString += '<span class="btn badge badge-danger">' +e.status+ '</span>'
                            }
                            ResultString += '</td>' +
                            '<td>'+'<div class="btn-group-sm">'+
                                    // '<a href="illnes/'+e.id+'/edit" class="btn btn-primary">'+'<i class="fa fa-edit">'+'</i>'+'</a>'+
                                    `<a onclick='IllnessModel(${val2})' class='btn btn-primary'><i class='fa fa-edit'></i></a>`+
                                    `<a onclick='DeleteData(${val2})' class='btn btn-danger'><i class='fa fa-trash'></i></a>`;
                                    // '<a href="ilnesdel/'+e.id+'" class="btn btn-danger">'+'<i class="fa fa-trash">'+'</i>'+'</a>';
                            if (e.status == "Active") {
                                ResultString += `<a onclick='StatusUpdate(${val2})' class='btn btn-warning'><i class='fa fa-ban'></i></a>`;
                                } else {
                                ResultString += `<a onclick='StatusUpdate(${val2})' class='btn btn-success'><i class='fa fa-check'></i></a>`;
                            }
                                '</div>'+'</td>' +
                            
                            '</tr>';
                        });
                        document.querySelector('#tabledata').innerHTML=ResultString; 

                }
            });
        }

        GetData();

        function DeleteData(illnessid){
            $.ajax({ 
                url:'{{url("ilnesdel")}}/'+illnessid,
                type: "GET",
                success: function(data){
                    Snackbar.show({
                        text           : 'Illness Delete Successfully',
                        pos            : 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                    GetData();
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

    
    
</script>

@endsection