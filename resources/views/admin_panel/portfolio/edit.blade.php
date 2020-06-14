@extends('common.index')
@section('page_title')
    {{trans('admin.edit portfolio')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit portfolio')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.portfolio')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit portfolio')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_portfolio', $portfolios[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="portfolio_name[1]" maxlength="100" placeholder="{{trans('admin.enter name arabic')}}" value="{{ $portfolios[0]->portfolio_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="portfolio_name[2]" maxlength="100" placeholder="{{trans('admin.enter name english')}}" value="{{ $portfolios[1]->portfolio_name }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="portfolio_title[1]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $portfolios[0]->portfolio_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="portfolio_title[2]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $portfolios[1]->portfolio_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.owner name')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="owner_name[1]" maxlength="100" placeholder="{{trans('admin.enter owner name')}}" value="{{ $portfolios[0]->owner_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.owner name')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="owner_name[2]" maxlength="100" placeholder="{{trans('admin.enter owner name')}}" value="{{ $portfolios[1]->owner_name }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.short description title')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="short_description_title[1]" maxlength="300" placeholder="{{trans('admin.enter short description title')}}" value="{{ $portfolios[0]->short_description_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.short description title')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="short_description_title[2]" maxlength="300" placeholder="{{trans('admin.enter short description title')}}" value="{{ $portfolios[1]->short_description_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.more description title')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="more_description_title[1]" rows="4" placeholder="{{trans('admin.enter more description title')}}" required>{{ $portfolios[0]->more_description_title }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.more description title')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="more_description_title[2]" rows="4" placeholder="{{trans('admin.enter more description title')}}" required>{{ $portfolios[1]->more_description_title }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.short description')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="short_description[1]" maxlength="300" placeholder="{{trans('admin.enter short description')}}" value="{{ $portfolios[0]->short_description }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.short description')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="short_description[2]" maxlength="300" placeholder="{{trans('admin.enter short description')}}" value="{{ $portfolios[1]->short_description }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.more description')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="more_description[1]" rows="4" placeholder="{{trans('admin.enter more description')}}" required>{{ $portfolios[0]->more_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.more description')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="more_description[2]" rows="4" placeholder="{{trans('admin.enter more description')}}" required>{{ $portfolios[1]->more_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.select service')}}</label>
                                <select class="form-control" name="service_id">
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{$portfolios[0]->service_id == $service->id? 'selected' : ''}}>{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="portfolio_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_portfolio_image" value="{{ $portfolios[0]->portfolio_image }}">
                                <img src="{{asset($portfolios[0]->portfolio_image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.portfolio link')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="portfolio_link" maxlength="200" placeholder="{{trans('admin.enter link')}}" value="{{ $portfolios[0]->portfolio_link }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.ios link')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="ios_link" maxlength="200" placeholder="{{trans('admin.enter link')}}" value="{{ $portfolios[0]->ios_link }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.android link')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="android_link" maxlength="200" placeholder="{{trans('admin.enter link')}}" value="{{ $portfolios[0]->android_link }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.date')}}</label>
                                <input type="date" class="form-control" name="date" placeholder="{{trans('admin.enter date')}}" value="{{ $portfolios[0]->date }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.cover')}}</label>
                                <input type="file" name="portfolio_cover" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_portfolio_cover" value="{{ $portfolios[0]->portfolio_cover }}">
                                <img src="{{asset($portfolios[0]->portfolio_cover)}}" class="img-thumbnail" height="70px" width="100px">
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