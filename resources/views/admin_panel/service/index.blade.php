@extends('common.index')
@section('page_title')
    {{trans('admin.services')}}
@endsection
@section('content')
    <!-- Page-header start -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.services')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.services')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.all services')}}</li>
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
                                <th>{{ trans('admin.image') }}</th>
                                <th>{{ trans('admin.activate') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$service->name}}</td>
                                <td><img src="{{asset($service->image)}}" class="rounded"></td>
                                <td>
                                    <input data-id="{{$service->id}}" data-table="services" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="{{trans('admin.active')}}" data-off="{{trans('admin.inactive')}}" {{ $service->active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info p-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('admin.action')}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url(route('edit_service', $service->id))}}">{{trans('admin.edit')}}</a>
                                            <button class="dropdown-item alerts" data-url="{{url('delete_service')}}/" data-table="datatable" data-id="{{ $service->id }}">{{trans('admin.delete')}}</button>
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