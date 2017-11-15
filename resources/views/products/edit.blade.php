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
                            <h3 class="box-title">Add new Product</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="/products/postedit/{{$product->id}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" value="{{$product->name}}">
                                </div>
                                <label>Category</label>
                                <div class="form-group">
                                    {!! Form::select('category', $categories, "{{$product->category_id}}",['class' => 'form-control']) !!}
                                </div>
                                <label>Brand</label>
                                <div class="form-group">
                                    {!! Form::select('brand', $brands, "{{$product->brand_id}}",['class' => 'form-control']) !!}
                                </div>
                                <label>Description</label>
                                <div class="form-group">
                                    <textarea class="form-control" name="description">{{$product->description}}</textarea>
                                </div>
                                <label>Price</label>
                                <div class="form-group">
                                    <input class="form-control" type="number" name="price" min="0.00" max="10000.00" step="0.01" value="{{$product->price}}" />
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="img">
                                </div>
                                <button class="btn btn-success" type="submit">Edit</button>
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
