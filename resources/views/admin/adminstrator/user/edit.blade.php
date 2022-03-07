@extends('layouts.app')

@section ('title')
    User Update
@endsection

@section ('header')
    User Update
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
                                    <h3>User Update Form</h3>
                                </div>
                            </div>

                            <form action="{{route('user.update',$row->id)}}" method="POST">
                                {{method_field('PUT')}}
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$row->name}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$row->email}}">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Update</button>
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


<script>
    function changeData(id,name){
        $.ajax({
            type : "POST",
            url:'{{url("illnesupdate")}}/'+id,
            data : {
                "_token"    :"{{csrf_token()}}",
                'id' : id,
                'name' : name,
            },      
            success: function(data){
                document.getElementById('name').value=data.name;
                Snackbar.show({
                    text: 'Illness Update Successfully',
                    pos: 'top-right',
                    backgroundColor: '#1B55E2'
                });
            }
        });
    }
</script>
@endsection