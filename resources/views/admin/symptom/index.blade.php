@extends('layouts.app')

@section ('title')
    Symptoms
@endsection

@section ('header')
    Symptoms List
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9 col-sm-9">
                                    <h3>Symptoms List</h3>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-3 text-right">
                                @if(\Laratrust::isAbleTo('symptoms-create'))
                                    <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                      Add Symptoms
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
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($symptoms as $key=> $symptom)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$symptom->name}}</td>
                                                <td id="{{$symptom->id}}">
                                                    @if($symptom->status == 'Active')
                                                    <span class="btn badge badge-info">{{$symptom->status}}</span>
                                                    @else
                                                    <span class="btn badge badge-danger">{{$symptom->status}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group-sm">
                                                    @if(\Laratrust::isAbleTo('symptoms-delete'))
                                                        @if($symptom->status == 'Active')
                                                        <a onclick="StatusUpdate({{$symptom->id}})" class="btn btn-warning"><i class="fa fa-ban"></i></a> 
                                                        @else
                                                        <a onclick="StatusUpdate({{$symptom->id}})" class="btn btn-success"><i class="fa fa-check"></i></a> 
                                                        @endif
                                                    @endif
                                                    @if(\Laratrust::isAbleTo('symptoms-update'))
                                                        <a href="{{route('symptom.edit',$symptom->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if(\Laratrust::isAbleTo('symptoms-delete'))
                                                        <a href="{{url('symptomdel',$symptom->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Add Symptom</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form class="mt-0" id="form" method="POST" action="{{route('symptom.store')}}">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name : <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
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
<!-- <script>
    $(function() {
        table = $('#zero-configs').DataTable( {
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            "bInfo": false ,
            ajax: "{!! url('symptomlist') !!}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ],
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
            },
            // "order": [[ 3, "desc" ]],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 50,
            drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
        } );
    });
</script> -->

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
        function StatusUpdate(symptom_id){
            $.ajax({ 
                url:'{{url("symptom_status")}}',
                data: {
                    "_token"    :"{{csrf_token()}}",
                    symptom_id:symptom_id, 
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
                    document.getElementById(symptom_id).innerHTML=html;
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