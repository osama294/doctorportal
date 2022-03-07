@extends('layouts.app')

@section ('title')
    Check Date Slots
@endsection

@section ('header')
    Check Date Slots List
@endsection

@section('content')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <form action="{{route('check_date_slot')}}"  method="POST">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-sm-4">
                                        <h3>Check Date Slots List</h3>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    {{csrf_field()}}
                                    <div class="col-xl-4 col-lg-4 col-sm-4 ">
                                        <div class="form-group">
                                            <label>Select Date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-sm-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <!-- <input type="button" class="btn btn-primary btn-block" onclick="getDate(document.getElementById('date').value)";  id="button_check" value="Check"> -->
                                            <input type="submit" class="btn btn-primary btn-block" value="Check">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover" id="zero-config" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$slots)
                                            @foreach ($slots as $key=> $slot)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$slot->start_time}}</td>
                                                    <td>{{$slot->end_time}}</td>
                                                    <td>{{$slot->date}}</td>
                                                    <td>{{$slot->description}}</td>
                                                    <td>
                                                        @if($slot->status == 'Available')
                                                            <span class="badge badge-info">{{$slot->status}}</span>
                                                            @else
                                                            <span class="badge badge-danger">{{$slot->status}}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
//      function getDate(id){
//         $.ajax({
//             type : "POST",
//             url:'{{url("getdateslots")}}/'+id,
//             data : {
//                 "_token"    :"{{csrf_token()}}",
//                 'id' : id,
//             },      
//             success: function(data){
//                var bodyData='';
//                var i=1;
//                 $.each(data,function(index,row){
//                     console.log(row);
//                     bodyData+="<tr>"
//                     bodyData+="<td>"+ i++ +"</td><td>"+
//                     row.start_time+"</td><td>"+
//                     row.end_time+"</td>"+"<td>"+
//                     row.description+"</td>"+"<td>"+
//                     (row.status=='Available' ? '<span class="badge badge-info">'+row.status+'</span>' : '<span class="badge badge-danger">'+row.status+'</span>')
//                     "</td>";
//                     bodyData+="</tr>";
//                 })
//             }
//         });
// }
</script>
@endsection
