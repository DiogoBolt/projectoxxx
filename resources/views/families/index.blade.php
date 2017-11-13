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

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Families</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($families as $family)
                                        <tr>
                                            <td>{{$family->name}}</td>
                                            <td><a class="btn btn-warning" href="/families/edit/{{$family->id}}">Edit</a></td>
                                            <td><a class="btn btn-danger" href="/families/delete/{{$family->id}}" onclick="return confirm('Are you sure?')" >Delete</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="/families/new" class="btn btn-sm btn-info btn-flat pull-left">Add New Family</a>
                        </div>
                        <!-- /.box-footer -->
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
