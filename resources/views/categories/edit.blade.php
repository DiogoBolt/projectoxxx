@extends('layouts.admin')

@section('header')
    @include('layouts.header')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="main-contend home-back">
        <div class="main">
            <div class="box">
                <div class="box-body">

                    @include('layouts.info')

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit {{$category->name}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="/categories/postedit/{{$category->id}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" value="{{$category->name}}">

                                </div>
                                <div class="form-group">
                                    {!! Form::select('family', $families, '',['class' => 'form-control']) !!}
                                </div>
                                <button class="btn btn-warning" type="submit">Edit</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/assets/plugins/morris.js-0.5.1/morris.min.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/moment.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>

</script>
@endsection
