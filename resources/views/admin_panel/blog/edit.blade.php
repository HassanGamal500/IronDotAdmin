@extends('common.index')
@section('page_title')
    {{trans('admin.edit blog')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit blog')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.blog')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit blog')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_blog', $blogs[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="blog_title[1]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $blogs[0]->blog_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="blog_title[2]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $blogs[1]->blog_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.sub content')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()-<>]+$" name="blog_sub_content[1]" maxlength="300" placeholder="{{trans('admin.enter sub content')}}" value="{{ $blogs[0]->blog_sub_content }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.sub content')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="blog_sub_content[2]" maxlength="300" placeholder="{{trans('admin.enter sub content')}}" value="{{ $blogs[1]->blog_sub_content }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" id="articleContentAR" type="text" name="blog_content[1]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ $blogs[0]->blog_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" id="articleContentEN" type="text" name="blog_content[2]" rows="4" placeholder="{{trans('admin.enter content')}}" required>{{ $blogs[1]->blog_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.date')}}</label>
                                <input type="date" class="form-control" name="date" placeholder="{{trans('admin.enter date')}}" value="{{ $blogs[0]->blog_date }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="blog_image_small" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_blog_image_small" value="{{ $blogs[0]->blog_image_small }}">
                                <img src="{{asset($blogs[0]->blog_image_small)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.cover')}}</label>
                                <input type="file" name="blog_image_large" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_blog_image_large" value="{{ $blogs[0]->blog_image_large }}">
                                <img src="{{asset($blogs[0]->blog_image_large)}}" class="img-thumbnail" height="70px" width="100px">
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