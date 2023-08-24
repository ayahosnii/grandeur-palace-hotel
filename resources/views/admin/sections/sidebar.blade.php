<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="index.html"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        Dashboard
                    </span>

                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="dashboard-ecommerce.html" data-i18n="nav.dash.ecommerce">Booked Rooms</a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header">
                <span data-i18n="nav.category.general">
                    Items</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General">

                </i>

            </li>
            <li class=" nav-item">
                <a href="#"><i class="la la-paint-brush"></i>
                    <span class="menu-title" data-i18n="nav.color_palette.main">
                        Rooms
                    </span>
                    <span class="badge badge badge-light badge-pill float-right mr-2">{{\App\Models\admin\Room::count()}}</span>

                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms')}}" data-i18n="nav.color_palette.color_palette_blue_grey">
                            Rooms
                        </a>
                    </li>

                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms.create')}}" data-i18n="nav.color_palette.color_palette_primary">
                            Add a Room
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#"><i class="la la-paint-brush"></i>
                    <span class="menu-title" data-i18n="nav.color_palette.main">
                        Services
                    </span>
                    <span class="badge badge badge-light badge-pill float-right mr-2">{{\App\Models\Service::count()}}</span>

                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms')}}" data-i18n="nav.color_palette.color_palette_blue_grey">
                            Rooms
                        </a>
                    </li>

                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms.create')}}" data-i18n="nav.color_palette.color_palette_primary">
                            Add a Room
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header">
                <span data-i18n="nav.category.tables">Clients</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                                                                      data-placement="right" data-original-title="Tables"></i>
            </li>


            <li class=" nav-item">
                <a href="table-jsgrid.html">
                    <i class="la la-table"></i>
                    <span class="menu-title" data-i18n="nav.table_jsgrid.main">Reviews</span></a>
            </li>

            <li class=" nav-item">
                <a href="table-jsgrid.html">
                    <i class="la la-table"></i>
                    <span class="menu-title" data-i18n="nav.table_jsgrid.main">Contact-us</span></a>
            </li>

            <li class=" navigation-header">
                <span data-i18n="nav.category.general">
                    Staff Management</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General">

                </i>

            </li>
            <li class=" nav-item">
                <a href="#"><i class="la la-paint-brush"></i>
                    <span class="menu-title" data-i18n="nav.color_palette.main">
                        Jobs
                    </span>
                    <span class="badge badge badge-light badge-pill float-right mr-2">{{\App\Models\admin\Room::count()}}</span>

                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms')}}" data-i18n="nav.color_palette.color_palette_blue_grey">
                            Jobs
                        </a>
                    </li>

                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{route('admin.rooms.create')}}" data-i18n="nav.color_palette.color_palette_primary">
                            Add a job
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header">
                <span data-i18n="nav.category.addons">Invoices & Reports</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                                                                       data-placement="right" data-original-title="Add Ons"></i>
            </li>
        </ul>
    </div>
</div>
