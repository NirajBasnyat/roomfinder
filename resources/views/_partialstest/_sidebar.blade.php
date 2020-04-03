<!-- Sidebar  -->
<nav id="sidebar" style="background:#343a40;">
    <div class="sidebar-header p-0 m-0">
        <a href="{{route('/')}}"><img src="{{asset('images/logo_main.png')}}" alt="Logo" height="120px"
                                      width="120px" class="side_profile"/></a>
        <div class="row pl-5">
            <h6 class="float-left m-0 text-info side_profile">Welcome <i>{{Auth::user()->name}} </i></h6>
        </div>

    </div>
    <ul class="list-unstyled components">
        <li class="dr">
            <a href="#sidebar_dashboard" data-toggle="collapse" aria-expanded="false" data-parent="#sidebar"
               class="dropdown-toggle">
                <i class="fas fa-home"></i>
                <b>Dashboard</b>
            </a>
            <ul class="drm collapse list-unstyled m-0" id="sidebar_dashboard">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Update</a>
                </li>
            </ul>
        </li>

        {{----------------------------------------------- start of ROOM OWNER ----------------------------------------------}}
        @if(auth()->user()->role == 1)

            <li class="dr">
                <a href="#sidebar_accounting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-address-book"></i>
                    <b>Profile</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_accounting">
                    <li>
                        <a href="{{route('owner_profile',auth()->user()->name)}}">My Profile</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_class" data-toggle="collapse" aria-expanded="false" data-parent="#sidebar"
                   class="dropdown-toggle">
                    <i class="fas fa-chalkboard"></i>
                    <b>Room</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_class">
                    <li>
                        <a href="{{route('room.index')}}">All Rooms</a>
                    </li>
                    <li>
                        <a href="{{route('room.create')}}">Add New Room</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_notices" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-sticky-note"></i>
                    <b>Notices</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_notices">
                    <li>
                        <a href="#">All Notices</a>
                    </li>
                    <li>
                        <a href="#">Add Notices</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_feedback" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-comments"></i>
                    <b>Testimonials</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_feedback">
                    <li>
                        <a href="#">All Feedback</a>
                    </li>
                    <li>
                        <a href="#">Add Feedback</a>
                    </li>
                </ul>
            </li>

        @endif
        {{----------------------------------------------- end of ROOM OWNER ----------------------------------------------}}

        {{----------------------------------------------- start of ROOM SEEKER ----------------------------------------------}}

        @if(auth()->user()->role == 2)

            <li class="dr">
                <a href="#sidebar_accounting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-address-book"></i>
                    <b>Profile</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_accounting">
                    <li>
                        <a href="{{route('seeker_profile',auth()->user()->name)}}">My Profile</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_library" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-book-reader"></i>
                    <b>All Rooms</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_library">
                    <li>
                        <a href="{{route('seeker_room')}}">All Rooms</a>
                    </li>
                    <li>
                        <a href="{{route('my_rooms')}}">My Rooms</a>
                    </li>

                    <li>
                        <a href="{{route('my_bookmarks')}}">Bookmarks</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_feedback" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-comments"></i>
                    <b>Testimonials</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_feedback">
                    <li>
                        <a href="#">All Feedback</a>
                    </li>
                    <li>
                        <a href="#">Add Feedback</a>
                    </li>
                </ul>
            </li>


        @endif

        {{----------------------------------------------- end of ROOM SEEKER ----------------------------------------------}}

        {{----------------------------------------------- start of ADMIN --------------------------------------------------}}

        @if(auth()->user()->admin)

            <li class="dr">
                <a href="#sidebar_fee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <b>Users</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_fee">
                    <li>
                        <a href="{{route('admin.all_users')}}">All Users</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_exam" data-toggle="collapse" aria-expanded="false" data-parent="#sidebar"
                   class="dropdown-toggle">
                    <i class="fas fa-marker"></i>
                    <b>Room Category</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_exam">
                    <li>
                        <a href="{{route('room_category.index')}}">All Room Categories</a>
                    </li>
                </ul>
            </li>
            <li class="dr">
                <a href="#sidebar_routine" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-calendar-week"></i>
                    <b>Room Facilities</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_routine">
                    <li>
                        <a href="{{route('room_facility.index')}}">All Room Facilities</a>
                    </li>
                </ul>
            </li>

        @endif
        {{----------------------------------------------- end of ADMIN --------------------------------------------------}}



        @if(auth()->user()->role == 100)

            <li class="dr">
                <a href="#sidebar_fee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <b>Fees</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_fee">
                    <li>
                        <a href="#">All Fees</a>
                    </li>
                    <li>
                        <a href="#">Add New Fees</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="#sidebar_inventory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-dolly"></i>
                    <b>Inventory</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_inventory">
                    <li>
                        <a href="#">All Inventory</a>
                    </li>
                    <li>
                        <a href="#">Add Inventory</a>
                    </li>
                </ul>
            </li>
            <li class="dr">
                <a href="#sidebar_users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users"></i>
                    <b>Users</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_users">
                    <li>
                        <a href="#">All Users</a>
                    </li>
                    <li>
                        <a href="#">Add Users</a>
                    </li>
                </ul>
            </li>


            <li class="dr">
                <a href="#sidebar_setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-cogs"></i>
                    <b>Setting</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_setting">
                    <li>
                        <a href="#">All Settings</a>
                    </li>
                    <li>
                        <a href="#">General Settings</a>
                    </li>
                    <li>
                        <a href="#">Profile Settings</a>
                    </li>
                    <li>
                        <a href="#">Privacy Settings</a>
                    </li>
                </ul>
            </li>
            <li class="dr">
                <a href="#sidebar_appreance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-pallet"></i>
                    <b>Appreance</b>
                </a>
                <ul class="drm collapse list-unstyled m-0" id="sidebar_appreance">
                    <li>
                        <a href="#">Theme</a>
                    </li>
                </ul>
            </li>

            <li class="dr">
                <a href="/index.html">
                    <i class="fas fa-briefcase"></i>
                    <b>About</b>
                </a>
            </li>
            <li class="dr">
                <a href="#">
                    <i class="fas fa-question"></i>
                    <b>FAQ</b>
                </a>
            </li>
            <li class="dr">
                <a href="#">
                    <i class="fas fa-paper-plane"></i>
                    <b>Contact</b>
                </a>
            </li>
            @endif
    </ul>




    <div class="sidebar-footer">
        <ul class="p-0 m-0">
            <li class="" data-toggle="tooltip" data-html="true" data-placement="right" title="Settings">
                <a href="#">
                    <i class="fas fa-cog"></i>
                </a>
            </li>
            <li id="full" class="" data-toggle="tooltip" data-html="true" title="Screen Size"
                onclick="$('body').fullScreenHelper('toggle');">
                <a>
                    <i id="i_full" class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="" data-toggle="tooltip" data-html="true" title="Help">
                <a>
                    <i class="fas fa-question-circle"></i>
                </a>
            </li>
            <li class="" data-toggle="tooltip" data-html="true" title="Log-out">
                <a href="#">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

</nav>
