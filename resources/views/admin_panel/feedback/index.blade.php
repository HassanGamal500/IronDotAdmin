@extends('common.index')
@section('page_title')
    {{trans('admin.feedback')}}
@endsection
@section('content')
    <!-- Page-header start -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.feedback')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.feedback')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.all feedback')}}</li>
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
                                <th>{{ trans('admin.position') }}</th>
                                <th>{{ trans('admin.text') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$feedback->name}}</td>
                                    <td>{{$feedback->position}}</td>
                                    <td>{{$feedback->text}}</td>
                                    <td>
                                        <div>
                                            <button class="btn btn-danger alerts" data-url="{{url('feedback_delete')}}/" data-table="datatable" data-id="{{ $feedback->id }}">{{trans('admin.delete')}}</button>
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