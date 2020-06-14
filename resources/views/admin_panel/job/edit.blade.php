@extends('common.index')
@section('page_title')
    {{trans('admin.edit career')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit career')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.career')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit career')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_job', $jobs[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" name="job_title[1]" maxlength="80" placeholder="{{trans('admin.enter name arabic')}}" value="{{ $jobs[0]->job_title }}" required>
                            </div> 
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" name="job_title[2]" maxlength="80" placeholder="{{trans('admin.enter name english')}}" value="{{ $jobs[1]->job_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.description')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="job_description[1]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ $jobs[0]->job_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.description')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="job_description[2]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ $jobs[1]->job_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.start')}}</label>
                                <input type="date" class="form-control" name="job_start" value="{{ $jobs[1]->start_job }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.end')}}</label>
                                <input type="date" class="form-control" name="job_end" value="{{ $jobs[1]->end_job }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="job_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_job_image" value="{{ $jobs[0]->job_image }}">
                                <img src="{{asset($jobs[0]->job_image)}}" class="img-thumbnail" height="70px" width="100px">
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