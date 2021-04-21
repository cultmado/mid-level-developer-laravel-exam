@extends('admin.layouts.base')

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('admin.product.index') }}">Products</a></li>
        <li><span href="javascript:void(0)">Add New Product</span></li>
    </ul>
    <div class="row">
        <form class="form-horizontal" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2><i class="fa fa-pencil"></i> <strong>Add new Product</strong></h2>
                    </div>
                    <div class="form-group{{ $errors->has('product_image') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="product_image">Product Image</label>
    
                        <div class="col-md-9">
                            <img id="blah" src="{{asset('public/images/imgplaceholder.jpg')}}" alt="{{asset('public/images/imgplaceholder.jpg')}}" class="imgPreview" />
                            <input type="file" class="form-control" id="product_image" name="product_image" style="display: none;">
                        </div>
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
    
                    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="content">Content</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="content" id="summernote"></textarea>
                            @if($errors->has('content'))
                                <span class="help-block animation-slideDown">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group{{ $errors->has('product_category') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label" for="product_category">Product Category</label>
                        <div class="col-md-9">
                            @if(!$categories->isEmpty())
                                <h4></h4>
                                <select class="form-control" name="product_category" id="product_category">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if($errors->has('product_category'))
                                <span class="help-block animation-slideDown">{{ $errors->first('product_category') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('#summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                  // set focus to editable area after initializing summernote
            // toolbar: [
            //     ['style', ['style']],
            //     ['font', ['bold', 'underline', 'clear']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['insert', ['link']],
            //     ['view', ['help']]
            // ]
            });

            $("#product_image").change(function() {
                readURL(this);
            });

            $('.imgPreview').on('click', function() {
                $('#product_image').trigger('click');
            });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>

<style>
    .imgPreview {
        vertical-align: middle;
        width: 100%;
        height: 200px;
        border-radius: 10px;
    }
    .imgPreview:hover {
        cursor: hand;
    }
</style>