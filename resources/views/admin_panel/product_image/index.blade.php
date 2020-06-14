@extends('common.index')
@section('page_title')
    {{trans('admin.images')}}
@endsection
@section('content')
    <!-- Page-header start -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.images')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.products')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.all images')}}</li>
                </ol>
            </nav>
        </div>
        <!-- Page-header end -->

        <div class="row">
            <div class="mb-3 ml-4">
                <button type="button" class="btn btn-info p-3" data-toggle="modal" data-target="#image">{{trans('admin.add image')}}</button>
            </div>
        </div>

        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('error')}}
            </div>
        @elseif(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{session()->get('message')}}
            </div>
        @endif

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
                                <th>{{ trans('admin.image') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset($image->image)}}" class="img-thumbnail" style="height: 60px; width: 80px"></td>
                                <td>
                                    <button class="btn btn-danger p-3 alerts" data-url="{{url('delete_product_image')}}/" data-table="datatable" data-id="{{ $image->id }}">{{trans('admin.delete')}}</button>
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
    <!-- Modal -->
    <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.add image')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('store_product_image')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{trans('admin.image')}}</label>
                            <input type="file" name="image[]" class="form-control-file" placeholder="Enter Image" required multiple>
                            <input type="hidden" name="product_id" value="{{$id}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                        <button type="submit" class="btn btn-info">{{trans('admin.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Page-body end -->
@endsection