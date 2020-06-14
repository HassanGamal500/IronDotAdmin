@extends('common.index')
@section('page_title')
    {{trans('admin.dashboard')}}
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
    </div>
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> {{trans('admin.dashboard')}} </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/portfolios')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.portfolios')}} <i class="mdi mdi-monitor-multiple mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$portfolios}}</h2>
                    </a>    
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/products')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.products')}} <i class="mdi mdi mdi-library-books mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$products}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/services')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.services')}} <i class="mdi mdi-gift mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$services}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/blogs')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.blogs')}} <i class="mdi mdi-blogger mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$blogs}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/partners')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.partners')}} <i class="mdi mdi-nature-people mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$partners}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/teams')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.teams')}} <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$teams}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/contacts')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.contacts')}} <i class="mdi mdi-contact-mail mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$contacts}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white" style="height: 10rem;">
                <div class="card-body">
                    <a href="{{url('/feedbacks')}}" style="text-decoration: none;color: #fff;">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{trans('admin.feedbacks')}} <i class="mdi mdi-tooltip-text mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{$feedbacks}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection