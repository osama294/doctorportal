@extends('layouts.app')

@section ('title')
    Slots
@endsection

@section ('header')
    Slots List
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
                                    <h3>Add Slots List</h3>
                                </div>
                            </div>
                            
                            <form class="mt-0" id="form" method="POST" action="{{route('doctor_slots.store')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <input type="date" class="form-control" name="from" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input type="date" class="form-control" name="to" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Slots Quantity</label>
                                            <input type="number" min="0" class="form-control" name="total" id="howmany">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="button" onclick="addinputs()" class="btn btn-primary mt-2 mb-2 btn-block">Done</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $dt = Carbon\Carbon::now();
                                            $time = $dt->toTimeString();
                                        @endphp
                                        <tbody id="boxquantity">
                                            <tr>
                                                <td class="form-group">
                                                    <input type="time" class="form-control" name="start_time[]"  required="">
                                                </td>
                                                <td class="form-group">
                                                    <input type="time" class="form-control" name="end_time[]" required="">
                                                </td>
                                                <td class="form-group">
                                                    <input type="text" class="form-control" name="description[]" required="">
                                                </td>
                                                <td class="form-group">
                                                    <button type="button" class="btn btn-danger btn-sm remove_row" onclick="remove_tr(this)" id="remove_row"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary btn-xs mt-2 mb-2 btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-xl-10 col-lg-10 col-sm-10">
                                    <h3>Today Slots List</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" id="zero-config" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($slots as $key=> $slot)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$slot->date}}</td>
                                            <td>{{$slot->start_time}}</td>
                                            <td>{{$slot->end_time}}</td>
                                            <td>{{$slot->description}}</td>
                                            <td>
                                                @if($slot->status == 'Available')
                                                    <span class="badge badge-info">{{$slot->status}}</span>
                                                    @else
                                                    <span class="badge badge-danger">{{$slot->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group-sm">
                                                    <a href="{{route('doctor_slots.edit',$slot->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                                                    <a href="{{url('doctor_slotsdel',$slot->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
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
@endsection

    

@section('javascript')
<script>
    function addinputs(){
        // alert(0);
        $("#boxquantity tr").remove();
        for(var i = 0; i< $('#howmany').val(); i++){
            $('#boxquantity').append('<tr><td class="form-group"><input type="time" class="form-control" name="start_time[]"  required=""></td><td class="form-group"> <input type="time" class="form-control" name="end_time[]" required=""></td><td class="form-group"><input type="text" class="form-control" name="description[]" required=""></td><td class="form-group"><button type="button" class="btn btn-danger btn-sm remove_row" onclick="remove_tr(this)" id="remove_row" ><i class="fa fa-times"></i></button></td></tr>')
        }
    }

    function remove_tr(tr){
        var element =  tr.parentElement.parentElement;
        element.remove();
    }
</script>
@endsection