@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Search Room</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">My Rooms
                        </div>

                        <div class="card-body mt-0">
                            <div class="table-responsive">
                                <table id="myTable"
                                       class="table table-striped table-hover table-responsive-sm table-sm">
                                    <thead class="bg-green">
                                    <tr>
                                        <th>Room</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($rooms as $room)
                                        <tr>
                                            <td>{{$room->title}}</td>
                                            <td>{{$room->created_at}}</td>
                                            <td class="d-inline-flex">
                                                <a href="{{route('room.show',$room->id)}}" class="pt-1 pl-1"><i
                                                        class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Bookmarks found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$rooms->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

