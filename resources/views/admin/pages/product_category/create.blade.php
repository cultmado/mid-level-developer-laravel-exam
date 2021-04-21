`@extends('admin.layouts.base')

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('admin.product-categories.index') }}">Product Categories</a></li>
        <li><span href="javascript:void(0)">Add New Product Category</span></li>
    </ul>
    <div class="row">
        <form class="form-horizontal" action="{{route('admin.product-category.store')}}" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2><i class="fa fa-pencil"></i> <strong>Add new Product Category</strong></h2>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="title">Title</label>
    
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Enter title..">
                            @if($errors->has('title'))
                                <span class="help-block animation-slideDown">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <a href="{{ route('admin.product-categories.index') }}" class="btn btn-sm btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection