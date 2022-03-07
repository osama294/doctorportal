@extends('layouts.app')

@section ('title')
    Speciality
@endsection

@section ('header')
    Speciality List
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            
                        <form class="mt-0" id="form" method="POST" action="{{route('speciality.store')}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <h3>Add Speciality</h3>
                                    </div>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="row">
                                 @foreach ($subcate as $subcat)
                                    @php $check = ''; @endphp
                                    @foreach ($speciality as $key=> $row)
                                        @php
                                            if($row->subcat_id == $subcat->id){
                                                $check = "checked";
                                            }
                                        @endphp
                                    @endforeach

                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox checkbox-xl">
                                            <input type="checkbox" {{$check}} class="custom-control-input myCheckbox" value="{{$subcat->id}}" name="speciality[]" id="{{$subcat->id}}">
                                            <label class="custom-control-label" for="{{$subcat->id}}">{{$subcat->name}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block">Save</button>
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
                                    <h3>Speciality List</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" id="zero-config" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($speciality2 as $key=> $subcat)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$subcat->name}}</td>
                                            <td>
                                                <div class="btn-group-sm">
                                                    <a href="{{url('specialitydel',$subcat->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
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
</script>
@endsection