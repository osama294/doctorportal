@extends('layouts.app')

@section ('title')
    Slots Update
@endsection

@section ('header')
    Slots Update
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="offset-3 col-xl-6 col-lg-6 col-sm-6  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="row">
                        <div class="col-xl-10 col-lg-10 col-sm-10">
                            <h3 style="text-align:center;">Slots Update Form</h3>
                        </div>
                    </div>
                    <form class="mt-0" method="POST" action="{{route('doctor_slots.update',$row->id)}}">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" value="{{$row->date}}">
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="time" class="form-control" name="start_time" value="{{$row->start_time}}">
                        </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" class="form-control" name="end_time" value="{{$row->end_time}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" value="{{$row->description}}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Update</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<!--  END CONTENT AREA  -->

@endsection

   

@section('javascript')



@endsection