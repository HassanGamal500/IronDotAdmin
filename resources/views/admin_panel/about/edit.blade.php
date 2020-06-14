@extends('common.index')
@section('page_title')
    {{trans('admin.edit about us')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit about us')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.about us')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit about us')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_about', $about[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" name="about_us_title[1]" maxlength="100" placeholder="{{trans('admin.enter title')}}" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" value="{{ $about[0]->about_us_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2"  name="about_us_title[2]" maxlength="100" placeholder="{{trans('admin.enter title')}}" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" value="{{ $about[1]->about_us_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.short content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" name="about_us_short_content[1]" rows="4" maxlength="300" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" placeholder="{{trans('admin.enter short content')}}" required>{{ $about[0]->about_us_short_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.short content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" name="about_us_short_content[2]" rows="4" maxlength="300" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" placeholder="{{trans('admin.enter short content')}}" required>{{ $about[1]->about_us_short_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="about_us_content[1]" rows="4" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" placeholder="{{trans('admin.enter content')}}" required>{{ $about[0]->about_us_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="about_us_content[2]" rows="4" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" placeholder="{{trans('admin.enter content')}}" required>{{ $about[1]->about_us_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.goals content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="about_us_goals_content[1]" rows="4" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" placeholder="{{trans('admin.enter goals content')}}" required>{{ $about[0]->about_us_goals_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.goals content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="about_us_goals_content[2]" rows="4" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" placeholder="{{trans('admin.enter goals content')}}" required>{{ $about[1]->about_us_goals_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.vision content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="about_us_vision_content[1]" rows="4" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" placeholder="{{trans('admin.enter vision content')}}" required>{{ $about[0]->about_us_vision_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.vision content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="about_us_vision_content[2]" rows="4" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" placeholder="{{trans('admin.enter vision content')}}" required>{{ $about[1]->about_us_vision_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.partner short content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" name="about_us_partner_short_content[1]" rows="4" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" maxlength="300" placeholder="{{trans('admin.enter partner short content')}}" required>{{ $about[0]->about_us_partner_short_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.partner short content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" name="about_us_partner_short_content[2]" rows="4" maxlength="300" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" placeholder="{{trans('admin.enter partner short content')}}" required>{{ $about[1]->about_us_partner_short_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="about_us_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_about_us_image" value="{{ $about[0]->about_us_image }}">
                                <img src="{{asset($about[0]->about_us_image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.message image')}}</label>
                                <input type="file" name="about_us_message_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_about_us_message_image" value="{{ $about[0]->about_us_message_image }}">
                                <img src="{{asset($about[0]->about_us_message_image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.president image')}}</label>
                                <input type="file" name="about_us_message_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_president_image" value="{{ $about[0]->president_image }}">
                                <img src="{{asset($about[0]->president_image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-gradient-primary mr-2">{{trans('admin.submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection