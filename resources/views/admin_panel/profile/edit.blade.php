@extends('common.index')
@section('page_title')
    {{trans('admin.edit profile')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit profile')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.dashboard')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit profile')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_profile', $users->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.name')}}</label>
                                <input type="text" name="name" class="form-control defaultconfig-2" maxlength="50" placeholder="{{trans('admin.enter name')}}" value="{{$users->name}}">
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.phone')}}</label>
                                <input type="text" name="phone" class="form-control defaultconfig-2" maxlength="11" placeholder="{{trans('admin.enter phone')}}" value="{{$users->phone}}">
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.email')}}</label>
                                <input type="email" name="email" class="form-control defaultconfig-2" maxlength="80" placeholder="{{trans('admin.enter email')}}" value="{{$users->email}}">
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.password')}}</label>
                                <input type="password" name="password" class="form-control defaultconfig-2" maxlength="100" placeholder="{{trans('admin.enter new password')}}">
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.upload photo')}}</label>
                                <input type="file" name="image" id="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_image" value="{{$users->image}}">
                                <img src="{{asset($users->image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>
                            <button type="submit" class="btn btn-gradient-info mr-2">{{trans('admin.submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection