<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{request()->is('/')?'active':''}}">
            <a class="nav-link" href="{{url('/')}}">
                <span class="menu-title">{{trans('admin.dashboard')}}</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{request()->is('portfolios', 'add_portfolio')?'active':''}}{{request()->segment(2) == 'edit_portfolio'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-portfolio" aria-expanded="false" aria-controls="ui-portfolio">
                <span class="menu-title">{{trans('admin.portfolio')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-monitor-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="ui-portfolio">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/portfolios')?'active':''}}" href="{{url('/portfolios')}}">{{trans('admin.portfolios')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_portfolio')?'active':''}}" href="{{url('/add_portfolio')}}">{{trans('admin.add portfolio')}}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{request()->is('/products', '/add_product')?'active':''}}{{request()->segment(2) == 'edit_product'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
                <span class="menu-title">{{trans('admin.product')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-library-books menu-icon"></i>
            </a>
            <div class="collapse" id="ui-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/products')?'active':''}}" href="{{url('/products')}}">{{trans('admin.products')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_product')?'active':''}}" href="{{url('/add_product')}}">{{trans('admin.add product')}}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{request()->is('/services', '/add_service')?'active':''}}{{request()->segment(2) == 'edit_service'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-service" aria-expanded="false" aria-controls="ui-service">
                <span class="menu-title">{{trans('admin.service')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-gift menu-icon"></i>
            </a>
            <div class="collapse" id="ui-service">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/services')?'active':''}}" href="{{url('/services')}}">{{trans('admin.services')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_service')?'active':''}}" href="{{url('/add_service')}}">{{trans('admin.add service')}}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{request()->is('/blogs', '/add_blog')?'active':''}}{{request()->segment(2) == 'edit_blog'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-blog" aria-expanded="false" aria-controls="ui-blog">
                <span class="menu-title">{{trans('admin.blog')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-blogger menu-icon"></i>
            </a>
            <div class="collapse" id="ui-blog">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/blogs')?'active':''}}" href="{{url('/blogs')}}">{{trans('admin.blogs')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_blog')?'active':''}}" href="{{url('/add_blog')}}">{{trans('admin.add blog')}}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{request()->is('/partners', '/add_partner')?'active':''}}{{request()->segment(2) == 'edit_partner'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-partner" aria-expanded="false" aria-controls="ui-partner">
                <span class="menu-title">{{trans('admin.partner')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-nature-people menu-icon"></i>
            </a>
            <div class="collapse" id="ui-partner">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/partners')?'active':''}}" href="{{url('/partners')}}">{{trans('admin.partners')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_partner')?'active':''}}" href="{{url('/add_partner')}}">{{trans('admin.add partner')}}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{request()->is('/teams', '/add_team')?'active':''}}{{request()->segment(2) == 'edit_team'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-team" aria-expanded="false" aria-controls="ui-team">
                <span class="menu-title">{{trans('admin.team')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="ui-team">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/teams')?'active':''}}" href="{{url('/teams')}}">{{trans('admin.teams')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_team')?'active':''}}" href="{{url('/add_team')}}">{{trans('admin.add team')}}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{request()->is('/jobs', '/add_job')?'active':''}}{{request()->segment(2) == 'edit_job'?'active':''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-job" aria-expanded="false" aria-controls="ui-job">
                <span class="menu-title">{{trans('admin.career')}}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-gift menu-icon"></i>
            </a>
            <div class="collapse" id="ui-job">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{request()->is('/jobs')?'active':''}}" href="{{url('/jobs')}}">{{trans('admin.career')}}</a></li>
                    <li class="nav-item"> <a class="nav-link {{request()->is('/add_job')?'active':''}}" href="{{url('/add_job')}}">{{trans('admin.add career')}}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{request()->segment(2) == 'edit_about'?'active':''}}">
            <a class="nav-link" href="{{url('/edit_about')}}">
                <span class="menu-title">{{trans('admin.about us')}}</span>
                <i class="mdi mdi-information menu-icon"></i>
            </a>
        </li>        
        <li class="nav-item {{request()->is('/edit_setting')?'active':''}}">
            <a class="nav-link" href="{{url('/edit_setting')}}">
                <span class="menu-title">{{trans('admin.setting')}}</span>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{request()->is('/contacts')?'active':''}}">
            <a class="nav-link" href="{{url('/contacts')}}">
                <span class="menu-title">{{trans('admin.contact')}}</span><span id="notifyCount" class=""></span>
                <i class="mdi mdi-contact-mail menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{request()->is('/feedbacks')?'active':''}}">
            <a class="nav-link" href="{{url('/feedbacks')}}">
                <span class="menu-title">{{trans('admin.feedback')}}</span>
                <i class="mdi mdi-tooltip-text menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>