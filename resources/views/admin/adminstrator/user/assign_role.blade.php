@extends('layouts.app')

@section ('title')
    Assign Role
@endsection

@section ('header')
    Assign Role
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
                                    <h3>Assign Role Form</h3>
                                </div>
                            </div>

                            <form action="{{route('assigninsert',$row->id)}}" method="POST">
                            <!-- {{method_field('PUT')}} -->
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$row->name}}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$row->email}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Select Role</label>
                                        <select name="rolid" class="form-control">
                                            <option value="" selected="" disabled="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Assign Role</button>
                                </div>
                            </form>
                           <!-- <input type="text" class="form-control" value="" id="test"> -->
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->

@endsection

   

@section('javascript')



@endsection