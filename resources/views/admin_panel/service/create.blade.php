@extends('common.index')
@section('page_title')
    {{trans('admin.add service')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.add service')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.service')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.add service')}}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{session()->get('error')}}
                            </div>
                        @elseif(session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                {{session()->get('message')}}
                            </div>
                        @endif
                        <form class="forms-sample" method="post" action="{{route('store_service')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="service_name[1]" maxlength="100" placeholder="{{trans('admin.enter name arabic')}}" value="{{ old('service_name.1') }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="service_name[2]" maxlength="100" placeholder="{{trans('admin.enter name english')}}" value="{{ old('service_name.2') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="service_short_content[1]" maxlength="300" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ old('service_short_content.1') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="service_short_content[2]" maxlength="300" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ old('service_short_content.2') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="service_image" class="file-upload-default" required>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-gradient-info mr-2">{{trans('admin.submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection