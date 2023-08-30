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
                        <a class="menu-item" href="{{route('admin.services')}}" data-i18n="nav.color_palette.color_palette_blue_grey">
                            Services
                        </a>
                    </li>

                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{route('admin.services.create')}}" data-i18n="nav.color_palette.color_palette_primary">
                            Add a Service
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
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Jobs  </span>
                    <span
                        class="badge badge badge-light badge-pill float-right mr-2"> {{\App\Models\admin\Job::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{route('admin.jobs')}}"
                           data-i18n="nav.dash.ecommerce"> Show All </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.jobs.create')}}"
                           data-i18n="nav.dash.crypto">Add New Jobs</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Employees  </span>
                    <span
                        class="badge badge badge-light badge-pill float-right mr-2"> {{\App\Models\admin\Employee::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{route('admin.employees')}}"
                           data-i18n="nav.dash.ecommerce"> Show Employees </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.employees.create')}}"
                           data-i18n="nav.dash.crypto">Add a new employee</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Absents  </span>
                </a>
                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{route('admin.attendance')}}"
                           data-i18n="nav.dash.ecommerce"> Show attendance </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attendance.create')}}"
                           data-i18n="nav.dash.crypto">Add a new attendance</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.punctuality')}}"
                           data-i18n="nav.dash.crypto">مراجعة الالتزام بالمواعيد</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attendance.absence')}}"
                           data-i18n="nav.dash.crypto">مراجعة الغياب</a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header">
                <span data-i18n="nav.category.addons">Restaurant</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                                                                       data-placement="right" data-original-title="Add Ons"></i>
            </li>
            <li class="nav-item">
                <a href="">
                    <i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Meals  </span>
                    <span
                        class="badge badge badge-light badge-pill float-right mr-2"> {{\App\Models\admin\Meal::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{route('admin.meals')}}"
                           data-i18n="nav.dash.ecommerce"> Show All </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.meals.create')}}"
                           data-i18n="nav.dash.crypto">Add New Jobs</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
