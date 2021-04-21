@extends('admin.layouts.base')

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('admin.product.index') }}">Products</a></li>
        <li><span href="javascript:void(0)">Product Details</span></li>
    </ul>
    <div class="row">
        <div class="col-lg-12 block">
            <div class="block-title">
                <h2><strong>Product Details</strong></h2>

                <div class="block-options pull-right">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary"><strong><i class="fa fa-pencil"></i> Edit</strong></a>
                </div>
            </div>
            <div class="block-section">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('storage/app/'.$product->image) }}" alt="avatar" style="width: 100%; height: 200px;">
                    </div>
                    <div class="col-lg-6">
                        <h3>
                            <small>Product Title:</small> <strong>{{$product->title}}</strong>
                        </h3>

                        <h3>
                            <small>Product Category:</small> <strong>{{$product->categoryPerProduct->productCategory->title}}</strong>
                        </h3>

                        <h3>
                            <small>Date Created:</small> <strong>{{$product->created_at}}</strong>
                        </h3>
        
                        <h3><small>Product Content:</small></h3>
                        <div style="padding-left: 20px; border: 1px solid rgb(202, 199, 199); border-radius: 10px;">{!! $product->content !!}</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script type="text/javascript">
</script>