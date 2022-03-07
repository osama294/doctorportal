@extends('layouts.app')

@section ('title')
    Available Slots
@endsection

@section ('header')
    Available Slots List
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
                                    <h3>Available Slots List</h3>
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

    
