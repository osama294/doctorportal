@extends('layouts.app')

@section ('title')
    Reviews
@endsection

@section ('header')
    Reviews List
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
                                    <h3>Reviews List</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" id="zero-config" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($reviews as $key=> $review)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$review->user->name}}</td>
                                            <td>{{$review->description}}</td>
                                            <td>{{$review->created_at}}</td>
                                            <td class=""><span class="badge badge-info">{{$review->status}}</span></td>
                                            <td>
                                                <div class="btn-group-sm">
                                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
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

    
