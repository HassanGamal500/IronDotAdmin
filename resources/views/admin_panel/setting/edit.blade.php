@extends('common.index')
@section('page_title')
    {{trans('admin.edit setting')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> {{trans('admin.edit setting')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('admin.setting')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('admin.edit setting')}}</li>
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
                        <form class="forms-sample" method="post" action="{{route('update_setting', $setting[0]->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{trans('admin.address')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="address[1]" maxlength="300" placeholder="{{trans('admin.enter address')}}" required>{{ $setting[0]->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.address')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control maxlength-textarea" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="address[2]" maxlength="300" placeholder="{{trans('admin.enter address')}}" required>{{ $setting[1]->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.footer content')}} ({{trans('admin.arabic')}})</label>
                                <textarea class="form-control" type="text" pattern="^[\u0621-\u064A\u0660-\u0669\u06f0-\u06f9\s0-9_.,/{}@#!~%()<>-]+$" name="footer_content[1]" rows="4" placeholder="{{trans('admin.enter footer content')}}" required>{{ $setting[0]->footer_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{trans('admin.footer content')}} ({{trans('admin.english')}})</label>
                                <textarea class="form-control" type="text" pattern="^[A-Za-z0-9_.,/{}@#!~%()-<>\s]+$" name="footer_content[2]" rows="4" placeholder="{{trans('admin.enter footer content')}}" required>{{ $setting[1]->footer_content }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.phone')}}</label>
                                <input type="tel" class="form-control defaultconfig-2" name="phone" maxlength="11" placeholder="{{trans('admin.enter phone')}}" value="{{ $setting[0]->phone }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.fax')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="fax" maxlength="20" placeholder="{{trans('admin.enter fax')}}" value="{{ $setting[0]->fax }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.email')}}</label>
                                <input type="email" class="form-control defaultconfig-2" name="mail" maxlength="100" placeholder="{{trans('admin.enter email')}}" value="{{ $setting[0]->mail }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.contact email')}}</label>
                                <input type="email" class="form-control defaultconfig-2" name="contact_email" maxlength="100" placeholder="{{trans('admin.enter contact email')}}" value="{{ $setting[0]->contact_email }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.linkedin')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="linked_in" maxlength="200" placeholder="{{trans('admin.enter linkedin')}}" value="{{ $setting[0]->linked_in }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.youtube')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="youtube" maxlength="200" placeholder="{{trans('admin.enter youtube')}}" value="{{ $setting[0]->youtube }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.facebook')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="facebook" maxlength="200" placeholder="{{trans('admin.enter facebook')}}" value="{{ $setting[0]->facebook }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.twitter')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="twitter" maxlength="200" placeholder="{{trans('admin.enter twitter')}}" value="{{ $setting[0]->twitter }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.instagram')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="insta" maxlength="200" placeholder="{{trans('admin.enter linkedin')}}" value="{{ $setting[0]->insta }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.whatsapp')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="whats_app" maxlength="30" placeholder="{{trans('admin.enter whatsapp')}}" value="{{ $setting[0]->whats_app }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.currency')}}</label>
                                <input type="text" class="form-control defaultconfig-2" name="currency" maxlength="20" placeholder="{{trans('admin.enter currency')}}" value="{{ $setting[0]->currency }}">
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