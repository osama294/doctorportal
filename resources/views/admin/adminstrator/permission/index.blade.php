@extends('layouts.app')

@section ('title')
    Permission
@endsection


@section ('header')
    Permission List
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
                                <h3>Permission List</h3>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <!-- <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Permission
                                </button>
                            </div> -->
                        </div>
                        
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key=> $permission)
                                        <tr>
                                            <td class="px-5">{{ $key + 1 }}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->display_name}}</td>
                                            <td>{{$permission->description}}</td>
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
  
    <!-- Model Ended -->


@endsection
