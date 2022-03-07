@extends('layouts.app')

@section ('title')
    Assign Permission
@endsection

@section ('header')
    Assign Permission
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
                                    <h3>Assign Permission Form</h3>
                                </div>
                            </div>
                            <hr>

                            <form action="{{route('insertAndUpdatepermission',$role->id)}}" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    @foreach($permissions as $permission)
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="permission[]" value="{{$permission->id}}" {{(in_array($permission->id, $role_permissions)) ? 'checked': ''}} > {{$permission->description}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block">Assign Permission</button>
                                        </div>
                                    </div>
                                </div>
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