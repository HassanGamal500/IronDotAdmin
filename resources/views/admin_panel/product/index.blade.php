@extends('common.index')
@section('page_title')
    {{trans('admin.products')}}
@endsection
@section('content')
    <!-- Page-header start -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.products')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.products')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.all products')}}</li>
                </ol>
            </nav>
        </div>
        <!-- Page-header end -->

        <!-- Page-body start -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered text-center datatable" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.title') }}</th>
                                <th>{{ trans('admin.image') }}</th>
                                <th>{{ trans('admin.activate') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->title}}</td>
                                <td><img src="{{asset($product->image)}}" class="rounded"></td>
                                <td>
                                    <input data-id="{{$product->id}}" data-table="product" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="{{trans('admin.active')}}" data-off="{{trans('admin.inactive')}}" {{ $product->active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info p-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('admin.action')}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url(route('all_product_image', $product->id))}}">{{trans('admin.images')}}</a>
                                            <a class="dropdown-item" href="{{url(route('edit_product', $product->id))}}">{{trans('admin.edit')}}</a>
                                            <button class="dropdown-item alerts" data-url="{{url('delete_product')}}/" data-table="datatable" data-id="{{ $product->id }}">{{trans('admin.delete')}}</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page-body end -->
@endsection