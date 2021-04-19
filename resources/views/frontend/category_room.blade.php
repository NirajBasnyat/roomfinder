<!-- ********************HEADER - SECTION************************ -->

 @include('_inc._header')

<header>
    <nav class="navbar navbar-expand-lg  navbar-fixed">
        <a class="navbar-brand ml-2" href="{{route('/')}}"><img src="{{asset('app/images/logo_raw.png')}}" alt="logo" height="50px" width="50px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><img src="{{asset('app/images/icons/ham.png')}}" alt="ham" height="20px"
                                                   width=40px"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">

                @auth
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a href="{{ route('login') }}" class="nav-link btn btn-sm btn-outline-info">Login</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item mx-2">
                            <a href="{{ route('register') }}" class="nav-link btn btn-sm btn-outline-primary">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>

        </div>
    </nav>
</header>

<!-- *******************CATEGORY_ROOM-SECTION************************ -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-5 ">
                <div class="card-header text-center h4 py-5">All Rooms</div>

                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-green">
                                <tr>
                                    <th>Room</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category_rooms as $room)
                                <tr>
                                    <td>{{$room->titleLimit}}</td>
                                    <td>{{$room->created_at}}</td>
                                    <td>
                                        <a href="{{route('category_room_show',$room->id)}}" class="pt-1 pl-1">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- *******************FOOTER-SECTION************************ -->

@include('_inc._footer')
