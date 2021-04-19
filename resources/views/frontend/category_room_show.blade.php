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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    About Property
                                </div>

                                @include('room.room_info')

                                <div class="card-header"><span>More Details</span>
                                    <span class="btn green btn-sm float-right">
                                        <i class="far fa-eye"></i> views : <strong>{{$room->views}}</strong></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-muted pb-2">
                                        <b><i class="fas fa-book"></i> Property Description</b>
                                    </h5>
                                    <h6 style="text-align: justify" class="mb-5">{!!$room->description!!}</h6>

                                    <h6 class="green">
                                        <strong>Posted: {{$room->created_at}}</strong></h6>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header" onclick="minimize()">
                                    <h5>Images of Room
                                        <span class="float-right mr-2 topicons">
                                            <i id="minimizer" class="fas fa-angle-down fa-lg gray"></i>
                                        </span>
                                    </h5>
                                </div>
                                <div class="card-body card-collapse">
                                    @foreach($room->upload_groups as $upload_groups)
                                    <img src="<?= '/app/' . $upload_groups->upload->filepath . '/' . $upload_groups->upload->filename ?>"
                                        height="30px" width="30px">
                                    <a href="<?= route('/') . '/app/' . $upload_groups->upload->filepath . '/' . $upload_groups->upload->filename ?>"
                                        target="_blank">{{$upload_groups->upload->original_filename}}</a><br>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- @include('_inc._script') --}}


    @include('_inc._footer')
