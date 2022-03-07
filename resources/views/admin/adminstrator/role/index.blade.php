@extends('layouts.app')

@section ('title')
    Roles
@endsection


@section ('header')
    Roles List
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
                                <h3>Roles List</h3>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                            @if(\Laratrust::isAbleTo('role-create'))
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Role
                                </button>
                            @endif
                            </div>
                        </div>
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Role Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                @foreach ($roles as $key=> $role)
                                    <tr>
                                    <td>{{ $key + 1 }}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->display_name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td>
                                        @if($role->permissions->isEmpty())
                                                <label  class="btn badge badge-warning">No Permission</label>
                                            @else
                                              <label class="btn badge badge-primary">Assign Permission</label></td>
                                            @endif
                                        <td>
                                            <div class="btn-group-sm">
                                            @if(\Laratrust::isAbleTo('role-update'))
                                            <a href="{{route('role.edit',$role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a> 
                                            @endif
                                            @if(\Laratrust::isAbleTo('role-assign'))
                                                <a href="{{route('assigpermission',$role->id)}}" class="btn btn-warning"><i class="fa fa-share"></i></a>
                                            @endif
                                            </div>  
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> -->
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
            <h4 class="modal-title">Add Roles</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                
               <form action="{{route('role.store')}}" method="POST">
                    {{csrf_field()}}
                    
                    <div class="form-group">
                        <label class="">Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label class="">Display Name</label>
                        <input class="form-control" type="text" name="display_name">
                    </div>
                    <div class="form-group">
                        <label class="">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" class="btn btn-primary  btn-block" name="submit" value="Save">
                    </div>
             
                </form> 
            </div>
            <!-- <div class="modal-footer justify-content-center">
            
            </div> -->
        </div>
        </div>
    </div>
    <!-- Model Ended -->


@endsection
