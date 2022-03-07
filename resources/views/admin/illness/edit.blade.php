@extends('layouts.app')

@section ('title')
    Illness Update
@endsection

@section ('header')
    Illness Update
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
                                    <h3>Illness Update Form</h3>
                                </div>
                            </div>

                            <form class="mt-0">
                            <!-- <form class="mt-0" method="POST" action="{{route('illnes.update',$row->id)}}">
                                {{method_field('PUT')}}
                                {{csrf_field()}} -->
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" value="{{$row->name}}" id="name">
                                    <input type="hidden" class="form-control" value="{{$row->id}}" id="id">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleFormControlInput1">Image</label>
                                    <input type="file" class="form-co"image">
                                </div>  -->
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-block" onclick="changeData(document.getElementById('id').value,document.getElementById('name').value)" >Update</button>
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