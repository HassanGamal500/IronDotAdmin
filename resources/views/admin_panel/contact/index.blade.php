@extends('common.index')
@section('page_title')
    {{trans('admin.contact')}}
@endsection
@section('content')
    <!-- Page-header start -->
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.contact')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.contact')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.all contact')}}</li>
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
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{ trans('admin.phone') }}</th>
                                <th>{{ trans('admin.subject') }}</th>
                                <th>{{ trans('admin.message') }}</th>
                                <th>{{ trans('admin.country') }}</th>
                                <th>{{ trans('admin.website url') }}</th>
                                <th>{{ trans('admin.service name') }}</th>
                                <th>{{ trans('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$contact->contact_us_name}}</td>
                                    <td>{{$contact->contact_us_email}}</td>
                                    <td>{{$contact->contact_us_phone}}</td>
                                    <td>{{$contact->contact_us_subject}}</td>
                                    <td>{{$contact->contact_us_message}}</td>
                                    <td>{{$contact->contact_us_country}}</td>
                                    <td>{{$contact->website_url}}</td>
                                    <td>{{$contact->service_name}}</td>
                                    <td>
                                        <div>
                                            <button class="btn btn-danger alerts" data-url="{{url('contact_delete')}}/" data-table="datatable" data-id="{{ $contact->id }}">{{trans('admin.delete')}}</button>
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