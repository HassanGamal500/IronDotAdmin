@extends('common.index')
@section('page_title')
    {{trans('admin.edit product')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit product')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.product')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit product')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_product', $products[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="product_name[1]" maxlength="100" placeholder="{{trans('admin.enter name arabic')}}" value="{{ $products[0]->product_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.name')}}  ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="product_name[2]" maxlength="100" placeholder="{{trans('admin.enter name english')}}" value="{{ $products[1]->product_name }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.arabic')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="product_title[1]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $products[0]->product_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.title')}} ({{trans('admin.english')}})</label>
                                <input type="text" class="form-control defaultconfig-2" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="product_title[2]" maxlength="100" placeholder="{{trans('admin.enter title')}}" value="{{ $products[1]->product_title }}" required>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.more description title')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="more_description_title[1]" rows="4" placeholder="{{trans('admin.enter more description title')}}" required>{{ $products[0]->more_description_title }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.more description title')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="more_description_title[2]" rows="4" placeholder="{{trans('admin.enter more description title')}}" required>{{ $products[1]->more_description_title }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.more description')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" id="articleContentAR" name="more_description[1]" rows="4" placeholder="{{trans('admin.enter more description')}}" required>{{ $products[0]->more_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.more description')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" id="articleContentEN" name="more_description[2]" rows="4" placeholder="{{trans('admin.enter more description')}}" required>{{ $products[1]->more_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.image')}}</label>
                                <input type="file" name="product_image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                <br>
                                <input type="hidden" name="old_product_image" value="{{ $products[0]->product_image }}">
                                <img src="{{asset($products[0]->product_image)}}" class="img-thumbnail" height="70px" width="100px">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.portfolio link')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="product_link" maxlength="200" placeholder="{{trans('admin.enter link')}}" value="{{ $products[0]->product_link }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.date')}}</label>
                                <input type="date" class="form-control" name="date" placeholder="{{trans('admin.enter date')}}" value="{{ $products[0]->date }}" required>
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