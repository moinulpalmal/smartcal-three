<div id="controls">
    <!-- ================================================
    ================= SIDEBAR Content ===================
    ================================================= -->
    <aside id="sidebar">
        <div id="sidebar-wrap" class="">
            <div class="panel-group slim-scroll" role="tablist">
                <div class="panel panel-default">
                    <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                        <div class="panel-body">
                            <!-- ===================================================
                            ================= NAVIGATION Content ===================
                            ==================================================== -->
                            <ul id="navigation">
                                <li class="{{ (request()->is('home')) ? 'active' : '' }}"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
                                <li class="{{ (request()->is('admin*')) ? 'active open' : '' }}">
                                    <a role="button" tabindex="0"><i class="fa fa-cogs"></i> <span> Administration</span></a>
                                    <ul>
                                        <li class="{{ (request()->is('admin/user*')) ? 'active open' : '' }}">
                                            <a role="button" tabindex="0"><i class="fa fa-users"></i> <span>Users</span></a>
                                            <ul>
                                                <li class="{{ (request()->is('admin/user')) ? 'active' : '' }}" ><a href="{{route('admin.user')}}"><i class="fa fa-caret-right"></i> Current User List</a></li>
                                                @if(Auth::user()->hasTaskPermission('restoreuser', Auth::user()->id))
                                                    <li class="{{ (request()->is('admin/historical-user')) ? 'active' : '' }}" ><a href="{{route('admin.historical-user')}}"><i class="fa fa-caret-right"></i> Historical User List</a></li>
                                                @endif

                                                <li class="{{ (request()->is('admin/user/role')) ? 'active' : '' }}" ><a href="{{route('admin.user.role')}}"><i class="fa fa-caret-right"></i> User Roles</a></li>
                                                <li class="{{ (request()->is('admin/user/task')) ? 'active' : '' }}" ><a href="{{route('admin.user.task')}}"><i class="fa fa-caret-right"></i> User Tasks</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ (request()->is('admin/product-group')) ? 'active' : '' }}"><a href="{{route('admin.product-group')}}"><i class="fa fa-cog"></i> <span> Product Group</span></a></li>
                                        <li class="{{ (request()->is('admin/supplier')) ? 'active' : '' }}"><a href="{{route('admin.supplier')}}"><i class="fa fa-truck"></i> <span> Supplier</span></a></li>
                                        <li class="{{ (request()->is('admin/buyer')) ? 'active' : '' }}"><a href="{{route('admin.buyer')}}"><i class="fa fa-cart-plus"></i> <span> Buyer</span></a></li>
                                        <li class="{{ (request()->is('admin/delivery-location')) ? 'active' : '' }}"><a href="{{route('admin.delivery-location')}}"><i class="fa fa-building"></i> <span> Delivery Location</span></a></li>
                                        <li class="{{ (request()->is('admin/unit')) ? 'active' : '' }}"><a href="{{route('admin.unit')}}"><i class="fa fa-database"></i> <span> Unit</span></a></li>
                                        <li class="{{ (request()->is('admin/currency')) ? 'active' : '' }}"><a href="{{route('admin.currency')}}"><i class="fa fa-bank"></i> <span> Currency</span></a></li>
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->hasPermission('cartoon', Auth::user()->id))
                                    <li class="{{ (request()->is('cartoon*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Cartoon & Board</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('cartoon/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createcb', Auth::user()->id))
                                                        <li class="{{ (request()->is('cartoon/booking/new')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('cartoon/booking/recent')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('cartoon/booking/active')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('cartoon/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('cartoon/booking/search')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('cartoon/booking/report')) ? 'active' : '' }}"><a href="{{route('cartoon.booking.report')}}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                             <li class="{{ (request()->is('cartoon/product')) ? 'active' : '' }}"><a href="{{route('cartoon.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('elastic', Auth::user()->id))
                                    <li class="{{ (request()->is('elastic*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Elastic</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('elastic/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createe', Auth::user()->id))
                                                        <li class="{{ (request()->is('elastic/booking/new')) ? 'active' : '' }}"><a href="{{route('elastic.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('elastic/booking/recent')) ? 'active' : '' }}"><a href="{{route('elastic.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('elastic/booking/active')) ? 'active' : '' }}"><a href="{{route('elastic.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('elastic/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('elastic.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('elastic/booking/search')) ? 'active' : '' }}"><a href="{{route('elastic.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('elastic/booking/report')) ? 'active' : '' }}"><a href="{{route('elastic.booking.report')}}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('elastic/product')) ? 'active' : '' }}"><a href="{{route('elastic.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('fabric', Auth::user()->id))
                                    <li class="{{ (request()->is('fabric*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Fabric</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('fabric/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createf', Auth::user()->id))
                                                        <li class="{{ (request()->is('fabric/booking/new')) ? 'active' : '' }}"><a href="{{route('fabric.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('fabric/booking/recent')) ? 'active' : '' }}"><a href="{{route('fabric.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('fabric/booking/active')) ? 'active' : '' }}"><a href="{{route('fabric.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('fabric/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('fabric.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('fabric/booking/search')) ? 'active' : '' }}"><a href="{{route('fabric.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('fabric/booking/report')) ? 'active' : '' }}"><a href="{{ route('fabric.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('fabric/product')) ? 'active' : '' }}"><a href="{{route('fabric.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('tissue', Auth::user()->id))
                                    <li class="{{ (request()->is('tissue*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Tissue</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('tissue/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createt', Auth::user()->id))
                                                        <li class="{{ (request()->is('tissue/booking/new')) ? 'active' : '' }}"><a href="{{route('tissue.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('tissue/booking/recent')) ? 'active' : '' }}"><a href="{{route('tissue.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('tissue/booking/active')) ? 'active' : '' }}"><a href="{{route('tissue.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('tissue/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('tissue.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('tissue/booking/search')) ? 'active' : '' }}"><a href="{{ route('tissue.booking.search') }}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('tissue/booking/report')) ? 'active' : '' }}"><a href="{{ route('tissue.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('tissue/product')) ? 'active' : '' }}"><a href="{{route('tissue.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('interlining', Auth::user()->id))
                                    <li class="{{ (request()->is('interlining*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Interlining</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('interlining/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createi', Auth::user()->id))
                                                        <li class="{{ (request()->is('interlining/booking/new')) ? 'active' : '' }}"><a href="{{route('interlining.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('interlining/booking/recent')) ? 'active' : '' }}"><a href="{{route('interlining.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('interlining/booking/active')) ? 'active' : '' }}"><a href="{{route('interlining.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('interlining/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('interlining.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('interlining/booking/search')) ? 'active' : '' }}"><a href="{{ route('interlining.booking.search') }}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('interlining/booking/report')) ? 'active' : '' }}"><a href="{{ route('interlining.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('interlining/product')) ? 'active' : '' }}"><a href="{{route('interlining.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('qcsticker', Auth::user()->id))
                                    <li class="{{ (request()->is('qcsticker*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> QC Sticker</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('qcsticker/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createqcs', Auth::user()->id))
                                                        <li class="{{ (request()->is('qcsticker/booking/new')) ? 'active' : '' }}"><a href="{{route('qcsticker.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('qcsticker/booking/recent')) ? 'active' : '' }}"><a href="{{route('qcsticker.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('qcsticker/booking/active')) ? 'active' : '' }}"><a href="{{route('qcsticker.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('qcsticker/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('qcsticker.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('qcsticker/booking/search')) ? 'active' : '' }}"><a href="{{route('qcsticker.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('qcsticker/booking/report')) ? 'active' : '' }}"><a href="{{ route('qcsticker.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('qcsticker/product')) ? 'active' : '' }}"><a href="{{route('qcsticker.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('arrowsticker', Auth::user()->id))
                                    <li class="{{ (request()->is('asticker*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Arrow Sticker</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('asticker/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createas', Auth::user()->id))
                                                        <li class="{{ (request()->is('asticker/booking/new')) ? 'active' : '' }}"><a href="{{route('asticker.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('asticker/booking/recent')) ? 'active' : '' }}"><a href="{{route('asticker.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('asticker/booking/active')) ? 'active' : '' }}"><a href="{{route('asticker.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('asticker/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('asticker.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('asticker/booking/search')) ? 'active' : '' }}"><a href="{{route('asticker.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('asticker/booking/report')) ? 'active' : '' }}"><a href="{{ route('asticker.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('asticker/product')) ? 'active' : '' }}"><a href="{{route('asticker.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('gumtape', Auth::user()->id))
                                    <li class="{{ (request()->is('gumtape*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Gum Tape</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('gumtape/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('creategt', Auth::user()->id))
                                                        <li class="{{ (request()->is('gumtape/booking/new')) ? 'active' : '' }}"><a href="{{route('gumtape.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('gumtape/booking/recent')) ? 'active' : '' }}"><a href="{{route('gumtape.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('gumtape/booking/active')) ? 'active' : '' }}"><a href="{{route('gumtape.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('gumtape/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('gumtape.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('gumtape/booking/search')) ? 'active' : '' }}"><a href="{{route('gumtape.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('gumtape/booking/report')) ? 'active' : '' }}"><a href="{{ route('gumtape.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('gumtape/product')) ? 'active' : '' }}"><a href="{{route('gumtape.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('thread', Auth::user()->id))
                                    <li class="{{ (request()->is('thread*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Thread</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('thread/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createtd', Auth::user()->id))
                                                        <li class="{{ (request()->is('thread/booking/new')) ? 'active' : '' }}"><a href="{{route('thread.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('thread/booking/recent')) ? 'active' : '' }}"><a href="{{route('thread.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('thread/booking/active')) ? 'active' : '' }}"><a href="{{route('thread.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('thread/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('thread.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('thread/booking/search')) ? 'active' : '' }}"><a href="{{route('thread.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('thread/booking/report')) ? 'active' : '' }}"><a href="{{ route('thread.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('thread/product')) ? 'active' : '' }}"><a href="{{route('thread.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('poly', Auth::user()->id))
                                    <li class="{{ (request()->is('poly*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> Poly</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('poly/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('createp', Auth::user()->id))
                                                        <li class="{{ (request()->is('poly/booking/new')) ? 'active' : '' }}"><a href="{{route('poly.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('poly/booking/recent')) ? 'active' : '' }}"><a href="{{route('poly.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('poly/booking/active')) ? 'active' : '' }}"><a href="{{route('poly.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('poly/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('poly.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('poly/booking/search')) ? 'active' : '' }}"><a href="{{route('poly.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('poly/booking/report')) ? 'active' : '' }}"><a href="{{ route('poly.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('poly/product')) ? 'active' : '' }}"><a href="{{route('poly.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasPermission('generalitem', Auth::user()->id))
                                    <li class="{{ (request()->is('generalitem*')) ? 'active open' : '' }}">
                                        <a role="button" tabindex="0"><i class="fa fa-mortar-board"></i> <span> General Item</span></a>
                                        <ul>
                                            <li class="{{ (request()->is('generalitem/booking*')) ? 'active open' : '' }}">
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span> Bookings</span></a>
                                                <ul>
                                                    @if(Auth::user()->hasTaskPermission('creategi', Auth::user()->id))
                                                        <li class="{{ (request()->is('generalitem/booking/new')) ? 'active' : '' }}"><a href="{{route('generalitem.booking.new')}}"><i class="fa fa-caret-right"></i> <span> Create New</span></a></li>
                                                    @endif
                                                    <li class="{{ (request()->is('generalitem/booking/recent')) ? 'active' : '' }}"><a href="{{route('generalitem.booking.recent')}}"><i class="fa fa-caret-right"></i> <span> Recent</span></a></li>
                                                    <li class="{{ (request()->is('generalitem/booking/active')) ? 'active' : '' }}"><a href="{{route('generalitem.booking.active')}}"><i class="fa fa-caret-right"></i> <span> Active</span></a></li>
                                                    <li class="{{ (request()->is('generalitem/booking/delivery-complete')) ? 'active' : '' }}"><a href="{{route('generalitem.booking.delivery-complete')}}"><i class="fa fa-caret-right"></i> <span> Delivery Complete</span></a></li>
                                                    <li class="{{ (request()->is('generalitem/booking/search')) ? 'active' : '' }}"><a href="{{route('generalitem.booking.search')}}"><i class="fa fa-caret-right"></i> <span> Booking Search</span></a></li>
                                                    <li class="{{ (request()->is('generalitem/booking/report')) ? 'active' : '' }}"><a href="{{ route('generalitem.booking.report') }}"><i class="fa fa-caret-right"></i> <span> Booking Report</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('generalitem/product')) ? 'active' : '' }}"><a href="{{route('generalitem.product')}}"><i class="fa fa-cog"></i> <span> Product Setup</span></a></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                            <!--/ NAVIGATION Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--/ SIDEBAR Content -->
</div>
