<nav class="navbar navbar-expand-md navbar-dark bg-gray-dark m-0">
    <button class="btn text-white mr-3" id="sidebarCollapse"><i class="fas fa-align-left"></i></button>
    <a class="navbar-brand m-0 p-0" href="#"><img src="{{asset('images/logo_name_large.png')}}" alt="Code Alchemy" height="50px" width="50px" class="m-0 p-0"></a>
    <button class="btn text-white d-lg-none d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fas fa-ellipsis-v"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle info-number text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope mr-2"></i><span class="d-md-none">Messages</span>
                    <span class="badge badge-warning">9</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" toggled>
                    <div class="list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="image col-1 col-sm-1 col-md-2 col-lg-1 pt-2 pr-2 pl-0">
                                     <span class="p-1">
                                        <img src="{{asset('images/logo_image.png')}}" alt="Profile Image"/>
                                     </span>
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                    <div class="row ">
                                        <div class="col-sm-12">
                                           <span class="name">
                                               John Smith
                                           </span>
                                            <small class="text-muted time pull-right pr-2">1 days ago</small>
                                            <br>
                                        </div>
                                        <div class="col-sm-12 col-md-12 pr-1">
                                            <div class="message">
                                                Just text out your question and watch the responses roll in.
                                            </div>
                                            <small class="text-muted">Newsletters</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="image col-1 col-sm-1 col-md-2 col-lg-1 pt-2 pr-2 pl-0">
                                <span class="p-1">
                                    <img src="{{asset('images/logo_image.png')}}" alt="Profile Image"/>
                                </span>
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                    <div class="row ">
                                        <div class="col-sm-12">
                                           <span class="name">
                                               John Smith
                                           </span>
                                            <small class="text-muted time pull-right pr-2">2 days ago</small>
                                            <br>
                                        </div>
                                        <div class="col-sm-12 col-md-12 pr-1">
                                            <div class="message">
                                                Direct Messaging is a tool that students use to ask the instructor any
                                                questions about
                                                the
                                                course content. This is a tool that students and instructors can use to
                                                ask and answer
                                                questions about the course content, and for instructors to use to get
                                                dedicated feedback
                                                on
                                                the course. This is meant for 1:1 learning and feedback, not to promote
                                                or market to
                                                students.
                                            </div>
                                            <small class="text-muted">Direct Messaging Features</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="image col-1 col-sm-1 col-md-2 col-lg-1 pt-2 pr-2 pl-0">
                                  <span class="p-1">
                                     <img src="{{asset('images/logo_image.png')}}" alt="Profile Image"/>
                                  </span>
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 col-lg-10 pr-2 pr-1 ">
                                    <div class="row ">
                                        <div class="col-sm-12">
                                           <span class="name">
                                               John Smith
                                           </span>
                                            <small class="text-muted time pull-right pr-2">3 days ago</small>
                                            <br>
                                        </div>
                                        <div class="col-sm-12 col-md-12 pr-1">
                                            <div class="message">
                                                Hi, Jennifer Parker Welcome to the Canvas Community! I am so delighted
                                                that your Canvas
                                                training has directed you here, and you'll find that we are a large
                                                group of passionate
                                                educators ready and willing to help you.
                                            </div>
                                            <small class="text-muted">Welcome Freshers</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start nav-seemore">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                    <span> <b> See All </b></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown profile-dropdown">
                <a class="nav-link dropdown-toggle info-number text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <div class="dropdown-menu profile-dropdown-item dropdown-menu-right p-0" aria-labelledby="navbarDropdown" toggled>
                    <a class="dropdown-item p-0 profile" href="#">
                        <img src="{{auth()->user()->avatar(auth()->user()->role)}}" alt="Profile Image"/>
                    </a>

                    <a class="dropdown-item mt-2" href="
                                    @if(auth()->user()->role == 1)
                                         {{route('owner_profile',auth()->user()->name)}}
                                    @else
                                         {{route('seeker_profile',auth()->user()->name)}}
                                    @endif
                            "><i class="fas fa-user-edit mr-2"></i>Go to Profile</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-question-circle mr-2"></i>Help</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>
