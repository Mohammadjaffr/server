<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
                            <img alt="user-img" class="avatar avatar-xl brround" src="{{asset('assets/img/'.Auth::user()->path)}}"><span class="avatar-status profile-status bg-green"></span>
                        </div>
						<div class="user-info">
                            <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->email}}</h4>
                            <span class="mb-0 text-muted">{{Auth::user()->name}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 19 19" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="m16 8.5l1.53 1.53l-1.06 1.06L10 4.62l-6.47 6.47l-1.06-1.06L10 2.5l4 4v-2h2v4zm-6-2.46l6 5.99V18H4v-5.97zM12 17v-5H8v5h4z"/></svg><span class="side-menu__label">Home</span></a>
					</li>
					<li class="slide">
					</li>
                    @can('Setting')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span><i class="bx bx-cog side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path></i></span><span class="side-menu__label">Setting</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">

							<li><a class="slide-item" href="{{ url('/digger') }}">Diggers</a></li>
                            <li><a class="slide-item" href="{{ url('/pk')}}">Packing</a></li>
							<li><a class="slide-item" href="{{url('/unit')}}">Unit</a></li>
                            <li><a class="slide-item" href="{{url('/store') }}">Stores</a></li>
                            <li><a class="slide-item" href="{{url('/com') }}">Company</a></li>
                            <li><a class="slide-item" href="{{url('/item') }}">Items</a></li>

						</ul>
					</li>
                    @endcan
                    @can('Reportes')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="m11.9.39l1.4 1.4c1.61.19 3.5-.74 4.61.37s.18 3 .37 4.61l1.4 1.4c.39.39.39 1.02 0 1.41l-9.19 9.2c-.4.39-1.03.39-1.42 0L1.29 11c-.39-.39-.39-1.02 0-1.42l9.2-9.19a.996.996 0 0 1 1.41 0zm.58 2.25l-.58.58l4.95 4.95l.58-.58c-.19-.6-.2-1.22-.15-1.82c.02-.31.05-.62.09-.92c.12-1 .18-1.63-.17-1.98s-.98-.29-1.98-.17c-.3.04-.61.07-.92.09c-.6.05-1.22.04-1.82-.15zm4.02.93c.39.39.39 1.03 0 1.42s-1.03.39-1.42 0s-.39-1.03 0-1.42s1.03-.39 1.42 0zm-6.72.36l-.71.7L15.44 11l.7-.71zM8.36 5.34l-.7.71l6.36 6.36l.71-.7zM6.95 6.76l-.71.7l6.37 6.37l.7-.71zM5.54 8.17l-.71.71l6.36 6.36l.71-.71zM4.12 9.58l-.71.71l6.37 6.37l.71-.71z"/>
                            </svg>
                            <span class="side-menu__label">Reportes</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>

                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/report_vendor') }}">Vendors</a></li>
                            <li><a class="slide-item" href="{{ url('/report_client') }}">Clients</a></li>
                            <li><a class="slide-item" href="{{ ('report_invoice_rec') }}">Invoices_rec</a></li>
                            <li><a class="slide-item" href="{{ ('report_invoice_iss') }}">Invoices_iss</a></li>
						</ul>
					</li>
                    @endcan
                    @can('Users')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M13.2 10L11 13l-1-1.4L9 13l-2.2-3C3 11 3 13 3 16.9c0 0 3 1.1 6.4 1.1h1.2c3.4-.1 6.4-1.1 6.4-1.1c0-3.9 0-5.9-3.8-6.9zm-3.2.7L8.4 10l1.6 1.6l1.6-1.6l-1.6.7zm0-8.6c-1.9 0-3 1.8-2.7 3.8c.3 2 1.3 3.4 2.7 3.4s2.4-1.4 2.7-3.4c.3-2.1-.8-3.8-2.7-3.8z"/>
                            </svg>
                            <span class="side-menu__label">Users</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>






                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{url('/user') }}">Users</a></li>
                            <li><a class="slide-item" href="{{ url('/roles') }}">Roles</a></li>

						</ul>
					</li>
                    @endcan

                    @can('People')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-2.99 1.34-2.99 3S14.34 11 16 11zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5.01 6.34 5.01 8 6.34 11 8 11zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm8 0c-.29 0-.62.02-.97.05 1.16.84 2.21 2.02 2.72 3.51H24v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <span class="side-menu__label">People</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">
                            <li><a class="slide-item" href="{{url('/client') }}">Client</a></li>
                            <li><a class="slide-item" href="{{url('/vendor') }}">Vendor</a></li>
                            <li><a class="slide-item" href="{{ url('/transport') }}">Transport</a></li>

						</ul>
					</li>
                    @endcan
                    @can('Invoices')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M4 5H2v13h10v-2H4V5zm13.9-1.6l-1.3-1.3c-.4-.4-1.1-.5-1.6-.1l-1 1H5v12h9V9l4-4c.4-.5.3-1.2-.1-1.6zm-5.7 6l-2.5.9l.9-2.5L15 3.4L16.6 5l-4.4 4.4z"/>
                            </svg>
                            <span class="side-menu__label">Invoices</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
						<ul class="slide-menu">

                            <li><a class="slide-item" href="{{ url('/receive') }}">Receive</a></li>

                            <li><a class="slide-item" href="{{ url('/issue') }}">Issue</a></li>
						</ul>
					</li>
                    @endcan
                    @can('Archives section')
					<li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 4v2H1V4h18zM2 7h16v10H2V7zm11 3V9H7v1h6z"/>
                            </svg>
                            <span class="side-menu__label">Archives</span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>

                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/arch') }}">Archives</a></li>
						</ul>
					</li>
                    @endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
