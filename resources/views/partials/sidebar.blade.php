<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        <!-- <img src="/storage/avatars/{{ auth()->user()->avatar }}" class="avatar-sm rounded-circle mr-2"
        alt="admin-template"/>  -->

        <div class="media-body">
            @if(auth()->check())
            <h6 class="pro-user-name mt-0 mb-0">{{ auth()->user()->firstname }}</h6>
            <span class="pro-user-desc">{{auth()->user()->type}}</span>
            @endif
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="{{ route('settings.profile') }}" class="dropdown-item notify-item">
                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown-divider"></div>

                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Modules</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('users.index') }}">
                <i data-feather="archive"></i>
                <span> System Users </span>
                </a>
                </li> --}}


                @if(auth()->check() && auth()->user()->type == 'super-admin')
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="users"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('client.clients') }}"> <i class='uil uil-user-plus'></i> Clients</a>
                        </li>
                        <li>
                            <a href="{{ route('rider.riders') }}"> <i class='uil uil-backpack'></i> Riders</a>
                        </li>
                        <li>
                            <a href="{{ route('get-subscribers') }}"> <i class='uil uil-0-plus'></i> Subscriptions</a>
                        </li>
                    </ul>
                </li>
                <li>

                    <a href="javascript: void(0);">
                        <i data-feather="rss"></i>
                        <span> Responses</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('rider.feedback') }}"> <i class='uil uil-comment-notes'></i> On Riders</a>
                        </li>
                        <li>
                            <a href="{{ route('rider.client') }}"> <i class='uil uil-file-plus-alt'></i> On Clients</a>
                        </li>

                    </ul>
                </li>
                <li>

                    <a href="javascript: void(0);">
                        <i data-feather="gift"></i>
                        <span> Coupons </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('promo.create-promo') }}"> <i class='uil uil-dollar-sign'></i>Generate
                                Random</a>
                        </li>
                        <li>
                            <a href="{{ route('promo.create-promo-sequential') }}"> <i
                                    class='uil uil-file-contract-dollar'></i>Generate Sequential</a>
                        </li>

                        <li>
                            <a href="{{ route('promo.retrieve-promo') }}"> <i class='uil uil-dollar-alt'></i>Available
                                Codes</a>
                        </li>
                    </ul>
                </li>

                <li>

                    <a href="javascript: void(0);">
                        <i data-feather="key"></i>
                        <span> Assets </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('asset.all-branches-assets') }}"> <i class='uil uil-box'></i> Branches</a>
                        </li>
                        <li>
                            <a href="{{ route('asset.list-bikes') }}"> <i class='uil uil-flip-v-alt'></i> Motorbikes</a>
                        </li>
                        {{-- <li>
                                <a href="{{ route('asset.un-allocated') }}"> <i class='uil uil-10-plus'></i> Free
                        Motorbikes</a>
                </li> --}}

            </ul>
            </li>
            <li>

                <a href="javascript: void(0);">
                    <i data-feather="truck"></i>
                    <span> Package Delivery </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('trip.on-transit') }}"> <i class='uil uil-flip-v-alt'></i> Ongoing Trips</a>
                    </li>
                    <li>
                        <a href="{{ route('trip.delivered') }}"> <i class='uil uil-clock'></i> Successful Trips</a>
                    </li>
                    <li>
                        <a href="{{ route('trip.disputed') }}"> <i class='uil uil-envelope-times'></i> Cancelled
                            Trips</a>
                    </li>
                    <li>
                        <a href="{{ route('trip.requested-trips') }}"> <i class='uil uil-adjust-half'></i> Pending
                            Trips</a>
                    </li>
                </ul>
            </li>
            <li>

                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Notifications </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('sms.create') }}"> <i class='uil uil-envelope-add'></i> Send General SMS</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('corporate.send-bulk-sms') }}
                    "> <i class='uil uil-comment-message'></i> Corporate Bulk SMS</a>
            </li>
            <li>
                <a href="{{ route('sms.sent') }}"> <i class='uil uil-envelope-send'></i> SMS Sent</a>
            </li> --}}
            <li>
                <a href="{{ route('get-message') }}"> <i class='uil uil-envelope-open'></i> SMS From Website</a>
            </li>

            </ul>
            </li>
            <li>

                <a href="javascript: void(0);">
                    <i data-feather="archive"></i>
                    <span> Pricing </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('rate.list') }}"> <i class='uil uil-vertical-align-bottom'></i> Current
                            Rates</a>
                    </li>
                    <li>
                        <a href="{{ route('rate.create') }}"> <i class='uil uil-bring-bottom'></i> Add Package &
                            Rates</a>
                    </li>

                </ul>
            </li>

            {{-- unpaid trips --}}
            <li>
                <a href="javascript: void(0);">
                    <i data-feather="slash"></i>
                    <span> Unpaid Trips</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('trip.list-unpaid') }}"> <i class='uil uil-plus-circle'></i> Make Payment</a>
                    </li>
                    <li>
                        <a href="{{ route('trip.index') }}"> <i class='uil uil-bring-bottom'></i> All Unpaid Trips</a>
                    </li>

                </ul>
            </li>


            {{-- // --}}
            @else
            @endif
            @if(auth()->check() && auth()->user()->type == 'super-admin')
            <li>

                <a href="javascript: void(0);">
                    <i data-feather="octagon"></i>
                    <span> Employees </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('client.create') }}"> <i class='uil uil-user-plus'></i> Add Employees</a>
                    </li>
                    <li>
                        <a href="{{ route('client.get-employees') }}
                                    "> <i class='uil uil-file-exclamation-alt'></i> Employees List</a>
                    </li>
                    <li>
                        <a href="{{route('corporate.ride-history')}}
                                    "> <i class='uil uil-compass'></i> Trip History</a>
                    </li>
                </ul>
            </li>

        

            {{-- <li>
                    <a href="javascript: void(0);">
                        <i data-feather="mail"></i>
                        <span> SMS </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('corporate.send-one-sms') }}"> <i
                class='uil uil-comment-alt-message'></i> Send SMS</a>
            </li>
            <li>
                <a href="{{route('corporate.corporates-bulk-sms')}}
                                "> <i class='uil uil-list-ui-alt'></i> SMS History</a>
            </li>
            </ul>
            </li> --}}
            <li>

                <a href="javascript: void(0);">
                    <i data-feather="dollar-sign"></i>
                    <span> Payments </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('corporate.bill') }}"> <i class='uil uil-money-bill'></i> Outstanding
                            Bills</a>
                    </li>
                    <li>
                        <a href="{{route('payment.add-payments')}}" onclick="return false;"> <i
                                class='uil uil-money-insert'></i> Top Up (Coming Soon)</a>
                    </li>
                </ul>
            </li>

                @else
                @endif

                @if(auth()->check() && auth()->user()->type == 'super-admin')

                @canany(['create_users','view_users', 'manage_users', 'show_user', 'verify_user', 'restore_user'])
            <li class="menu-title">Account Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="database"></i>
                    <span> Corporates </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('corporate.show') }}"> <i class="uil uil-notes"></i> All Corporates</a>
                    </li>
                    <li>
                        <a href="{{ route('corporate.create') }}"> <i class="uil uil-file-medical"></i>
                            New Corporate</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <i data-feather="users"></i>
                    <span> System Users </span>
                </a>
            </li>
            @endcan

            @canany(['view_configs','view_roles', 'view_permissions'])
            <li class="menu-title">App Configurations</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    {{-- <li>
                                <a href="{{route('sms.push')}}"> <i class="uil uil-envelope"></i> Push
                    Notifications</a>
            </li> --}}
            <li>
                <a href="{{route('faq.show')}}"> <i class="uil uil-question-circle"></i> FAQs</a>
            </li>
            </ul>
            </li>
            <li class="menu-title">System Configurations</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="sliders"></i>
                    <span> Configurations </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('roles.index') }}"> <i class="uil uil-briefcase"></i> Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}"> <i class="uil uil-key-skeleton-alt"></i>
                            Permissions</a>
                    </li>

                </ul>
            </li>
            @endcanany

            <li class="menu-title">Reports</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="hash"></i>
                    <span> Payments </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('report.mpesa-statements')}}"> <i class="uil uil-money-bill"></i> Mpesa
                            statements</a>
                    </li>
                    <li>
                        <a href="{{route('report.income-report')}}"> <i class="uil uil-money-bill-stack"></i>
                            Income</a>
                    </li>

                    <li>
                        <a href="{{route('report.completed-rides')}}"> <i class="uil uil-check-circle"></i>
                            Completed Trips</a>
                    </li>
                    <li>
                        <a href="{{route('report.total-clients')}}"> <i class="uil uil-user-check"></i>
                            Successful client</a>
                    </li>
                    <li>
                        <a href="{{route('report.shipment')}}"> <i class="uil uil-user-check"></i>
                            Shiment Reports</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('request-payment.') }}"> <i class="uil uil-moneybag-alt"></i>
                    Off-System - Soon</a>
            </li> --}}

            </ul>
            </li>


            @can('view_configs')
            <li class="menu-title">Logs</li>

            {{--                    <li>--}}
            {{--                        <a href="javascript:void(0)">--}}
            {{--                            <i data-feather="cpu"></i>--}}
            {{--                            <span> All system Logs </span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            <li>
                <a href="{{ route('console') }}">
                    <i data-feather="copy"></i>
                    <span> All Technical Logs </span>
                </a>
            </li>
            @endcan




            <li class="menu-title">Ship Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Shipment</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('parcel.index') }}"> <i class="uil uil-file-medical"></i>
                            View Shipments</a>
                    </li>
                    <li>
                        <a href="{{ route('corporate.indexRegion') }}"> <i class="uil uil-file-medical"></i>
                            Region</a>
                    </li>
                    <li>
                        <a href="{{ route('corporate.mapRegion') }}"> <i class="uil uil-file-medical"></i>
                            Map Region</a>
                    </li>
                    <li>
                        <a href="{{route('report.all-shipments')}}"> All Shipments<i class="uil uil-check-circle"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('bulk.import') }}"> <i class="uil uil-file-medical"></i>
                            Upload Bulk</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="users"></i>
                    <span> User Management </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">

                    <li>
                        <a href="{{ route('rider.riders') }}"> <i class='uil uil-backpack'></i> Riders</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"> <i class='uil uil-0-plus'></i> System Users</a>
                    </li>
                </ul>
            </li>
            <li>
                @else
                @endif

                @if(auth()->check() && auth()->user()->type == 'corporate')

            <!-- <li>

                <a href="javascript: void(0);">
                    <i data-feather="octagon"></i>
                    <span> Employees </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('client.create') }}"> <i class='uil uil-user-plus'></i> Add Employees</a>
                    </li>
                    <li>
                        <a href="{{ route('client.get-employees') }}
                    "> <i class='uil uil-file-exclamation-alt'></i> Employees List</a>
                    </li>
                    <li>
                        <a href="{{route('corporate.ride-history')}}
                    "> <i class='uil uil-compass'></i> Trip History</a>
                    </li>
                </ul>
            </li> -->




            <li class="menu-title">Ship Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Shipment</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <!-- <li>
                        <a href="{{ route('parcel.index') }}"> <i class="uil uil-file-medical"></i>
                            Manage Shipments</a>
                    </li> -->
                    <!-- <li>
        <a href="{{ route('corporate.indexRegion') }}"> <i class="uil uil-file-medical"></i>
            Region</a>
    </li>
    <li>
        <a href="{{ route('corporate.mapRegion') }}"> <i class="uil uil-file-medical"></i>
            Map Region</a>
    </li> -->
                    <li>
                        <a href="{{route('parcel.corporate')}}"> <i class="uil uil-check-circle"></i> Track  Parcel
                        </a>
                    </li> 

                    <li>
                        <a href="{{ route('bulk.import-admin') }}"> <i class="uil uil-file-medical"></i>
                            Upload Bulk</a>
                    </li>

                </ul>
            </li>




            @else
            @endif
            @if(auth()->check() && auth()->user()->type == 'Admin')
			
				   <li class="menu-title">System Configurations</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="sliders"></i>
                    <span> Configurations </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('roles.index') }}"> <i class="uil uil-briefcase"></i> Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}"> <i class="uil uil-key-skeleton-alt"></i>
                            Permissions</a>
                    </li>

                </ul>
            </li>
		
       
			<li>
                <a href="javascript: void(0);">
                    <i data-feather="database"></i>
                    <span> Corporates </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('corporate.show') }}"> <i class="uil uil-notes"></i> All Corporates</a>
                    </li>
                    <li>
                        <a href="{{ route('corporate.create') }}"> <i class="uil uil-file-medical"></i>
                            New Corporate</a>
                    </li>
                </ul>
            </li>
			<li>
                <a href="javascript: void(0);">
                    <i data-feather="database"></i>
                    <span> Regions </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                     <li>
                        <a href="{{ route('corporate.indexRegion') }}"> <i class="uil uil-comment-medical"></i>
                            Region</a>
                    </li>
                    <li>
                        <a href="{{ route('corporate.mapRegion') }}"> <i class="uil uil-desert"></i>
                            Map Region</a>
                    </li>
                </ul>
            </li>

            <li>

                <a href="javascript: void(0);">
                    <i data-feather="key"></i>
                    <span> Assets </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                   
					 
                        <li>
                            <a href="{{ route('asset.list-bikes') }}"> <i class='uil uil-flip-v-alt'></i> Motorbikes/Vehicles</a>
                        </li>
                   

            </ul>
            </li>

        
         

            <li class="menu-title">Ship Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Shipment</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('parcel.index') }}"> <i class="uil uil-file-medical"></i>
                            Manage Shipments</a>
                    </li>
                 

                    <li>
                        <a href="{{ route('bulk.import') }}"> <i class="uil uil-file-medical"></i>
                            Upload Bulk</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="users"></i>
                    <span> User Management </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">

                    <li>
                        <a href="{{ route('rider.riders') }}"> <i class='uil uil-backpack'></i> Riders</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"> <i class='uil uil-0-plus'></i> System Users</a>
                    </li>
                </ul>
            </li>
            <li>

            <li>
                    <a href="javascript: void(0);">
                        <i data-feather="users"></i>
                        <span> Reports </span>
                        <span class="menu-arrow"></span>
                    </a>


                    <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('report.all-shipments')}}"> <i class="uil uil-check-circle"></i>All Shipments
                        </a>
                    </li>
                        <li>
                            <a href="{{ route('report.filter-status-report') }}"> <i class='uil uil-user-plus'></i>Status Report</a>
                        </li>
                        <li>
                            <a href="{{ route('report.filter-payment-report') }}"> <i class='uil uil-backpack'></i>Payment Mode  Report</a>
                        </li>
                        <li>
                            <a href="{{ route('report.filter-branch-report') }}"> <i class='uil uil-0-plus'></i> Branch Report</a>
                        </li>
						  <li>

                            <a href="{{ route('report.filter-corporate-financial-report') }}"> <i class='uil uil-0-plus'></i>Corporate Financial Report </a>
                        </li>
                    </ul>
                </li>

            @else
            @endif
            @if(auth()->check() && auth()->user()->type == 'Sorting Officer')

            <li class="menu-title">Ship Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Shipment</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('parcel.index') }}"> <i class="uil uil-file-medical"></i>
                            View Shipments</a>
                    </li>
		</ul>

					
					


            </li>
            @else
            @endif

            @if(auth()->check() && auth()->user()->type == 'Collection Officer')
            <li class="menu-title">Ship Management</li>

            <li>
                <a href="javascript: void(0);">
                    <i data-feather="smartphone"></i>
                    <span> Shipment</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{ route('parcel.index') }}"> <i class="uil uil-file-medical"></i>
                            View Shipments</a>
                    </li>
                      <li>
                        <a href="{{ route('bulk.import') }}"> <i class="uil uil-file-medical"></i>
                            Collect Bulk Parcels</a>
                    </li>
			</ul>



            </li>


            @else
            @endif

            @canany(['create_groups', 'setCheckoff_dates', 'access_registry'])


            @endcan


            <br><br>
            <li>
                <a href="{{ route('logout') }}">
                    <i data-feather="power"></i>
                    <span> Logout </span>
                </a>
            </li>
            </ul>

        </div>

        <div class="clearfix"></div>
    </div>

</div>