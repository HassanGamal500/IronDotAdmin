@extends('common.index')
@section('page_title')
    {{trans('admin.add blog')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.add blog')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.blog')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.add blog')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('store_blog')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="blog_title[1]" maxlength="150" placeholder="{{trans('admin.enter title')}}" value="{{ old('blog_title.1') }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="blog_title[2]" maxlength="150" placeholder="{{trans('admin.enter title')}}" value="{{ old('blog_title.2') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.sub content')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="blog_sub_content[1]" maxlength="300" placeholder="{{trans('admin.enter sub content')}}" value="{{ old('blog_sub_content.1') }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.sub content')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="blog_sub_content[2]" maxlength="300" placeholder="{{trans('admin.enter sub content')}}" value="{{ old('blog_sub_content.2') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" id="articleContentAR" type="text" name="blog_content[1]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ old('blog_content.1') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" id="articleContentEN" type="text" name="blog_content[2]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ old('blog_content.2') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.date')}}</label>
                                <input type="date" class="form-control" name="date" placeholder="{{trans('admin.enter date')}}" value="{{ old('date') }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.small image')}}</label>
                                <input type="file" name="blog_image_small" class="file-upload-default" required>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.large image')}}</label>
                                <input type="file" name="blog_image_large" class="file-upload-default" required>
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