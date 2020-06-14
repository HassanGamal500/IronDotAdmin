@extends('common.index')
@section('page_title')
    {{trans('admin.add career')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.add career')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.career')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.add career')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('store_job')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" name="job_title[1]" maxlength="80" placeholder="{{trans('admin.enter name arabic')}}" value="{{ old('job_title.1') }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" name="job_title[2]" maxlength="80" placeholder="{{trans('admin.enter name english')}}" value="{{ old('job_title.2') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.description')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="job_description[1]" row="6" placeholder="{{trans('admin.enter content')}}" required>{{ old('job_description.1') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.description')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="job_description[2]" row="6" placeholder="{{trans('admin.enter content')}}" required>{{ old('job_description.2') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.start')}}</label>
                                <input type="date" class="form-control" name="job_start" value="{{ old('job_start') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.end')}}</label>
                                <input type="date" class="form-control" name="job_end" value="{{ old('job_end') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="job_image" class="file-upload-default" required>
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