@extends('admin.layouts.base')

@section('content')
    {{-- @if (auth()->user()->can('Create User')) --}}
        <div class="row text-center">
            <div class="col-sm-12 col-lg-12">
                <a href="{{ route('admin.product-category.create') }}" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background">
                        <h4 class="widget-content-light"><strong>Add New Product Category</strong></h4>
                    </div>
                    <div class="widget-extra-full"><span class="h2 text-primary animation-expandOpen"><i
                                    class="fa fa-plus"></i></span></div>
                </a>
            </div>
        </div>
    {{-- @endif --}}
    <div class="block full">
        <div class="block-title">
            <h2><i class="fa fa-list sidebar-nav-icon"></i>&nbsp;<strong>Product Categories</strong></h2>
        </div>
        {{-- <div class="alert alert-info alert-dismissable user-empty {{$users->count() == 0 ? '' : 'johnCena' }}">
            <i class="fa fa-info-circle"></i> No users found.
        </div> --}}
        <div class="table-responsive">
            <table id="users-table"
                   class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr role="row">
                    <th class="text-left">
                        Title
                    </th>
                    <th class="text-center">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                    @if ($productCategories && count($productCategories) > 0)
                        @foreach ($productCategories as $productCategory)
                            <tr>
                                <td>{{$productCategory->title}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.product-category.show', ['id' => $productCategory->id])}}" class="btn btn-success">View</a>
                                    <a href="{{route('admin.product-category.edit', ['id' => $productCategory->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger delete-product-category-btn" id="{{$productCategory->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="2">
                                No Item(s) Found.
                            </td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script>
    $(function() {
        $('.delete-product-category-btn').on('click', function() {
            const trigger = () => {
                $.ajax({
                    url:"{{ route('admin.product-category.delete') }}",
                    method:"DELETE",
                    data: {
                        _token:'{{csrf_token()}}',
                        id: $(this).attr('id')
                    },
                    success:function(data)
                    {
                        location.reload();
                    },
                    error: function(err) {
                        alert(data);
                    }
                });
            }

            swal({
                title: 'Delete Product Category?',
                text: 'Are you sure you want to delete the product category?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }, function() {
                trigger();
            });
        });
    });
</script>