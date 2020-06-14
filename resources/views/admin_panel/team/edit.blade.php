@extends('common.index')
@section('page_title')
    {{trans('admin.edit team')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit team')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.team')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit team')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_team', $teams->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.name')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_name" maxlength="100" placeholder="{{trans('admin.enter name')}}" value="{{ $teams->teams_name }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.position')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_position" maxlength="100" placeholder="{{trans('admin.enter position')}}" value="{{ $teams->teams_position }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.facebook')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_fb" maxlength="200" placeholder="{{trans('admin.enter facebook')}}" value="{{ $teams->teams_fb }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.twitter')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_tw" maxlength="200" placeholder="{{trans('admin.enter twitter')}}" value="{{ $teams->teams_tw }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.linkedin')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_in" maxlength="200" placeholder="{{trans('admin.enter linkedin')}}" value="{{ $teams->teams_in }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.instagram')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="teams_insta" maxlength="200" placeholder="{{trans('admin.enter instagram')}}" value="{{ $teams->teams_insta }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.cover')}}</label>
                                <input type="file" name="teams_cover" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_teams_cover" value="{{ $teams->teams_cover }}">
                                <img src="{{asset($teams->teams_cover)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="teams_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_teams_image" value="{{ $teams->teams_image }}">
                                <img src="{{asset($teams->teams_image)}}" class="img-thumbnail" height="70px" width="100px">
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