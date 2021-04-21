@extends('admin.layouts.base')

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('admin.product-categories.index') }}">Product Categories</a></li>
        <li><span href="javascript:void(0)">Product Category Details</span></li>
    </ul>
    <div class="row">
        <div class="col-lg-12 block">
            <div class="block-title">
                <h2><strong>Product Category Details</strong></h2>

                <div class="block-options pull-right">
                    <a href="{{ route('admin.product-category.edit', $productCategory->id) }}" class="btn btn-primary"><strong><i class="fa fa-pencil"></i> Edit</strong></a>
                </div>
            </div>
            <div class="block-section">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>
                            <small>Title:</small> <strong>{{$productCategory->title}}</strong>
                        </h3>

                        <h3>
                            <small>Date Created:</small> <strong>{{$productCategory->created_at}}</strong>
                        </h3>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script type="text/javascript">
</script>