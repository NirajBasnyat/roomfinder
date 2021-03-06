@extends('layouts.master')

@section('content')

    <div class="container-fluid pl-3 pr-3">
        <div class="row">
            <div class="col-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 nodecorationlist">
                        <li class="breadcrumb-item green"><a href="{{route('home')}}" class="green"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li class="breadcrumb-item active gray" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('_partialstest._messages')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">All Categories
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-green float-right" data-toggle="modal"
                                    data-target="#addCategory">
                                <i class="fas fa-plus"></i> Add Category
                            </button>
                        </div>
                        <!--Create Modal -->
                        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{route('room_category.store')}}" method="POST">
                                @csrf
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Room Category</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Category Name</span>
                                                </div>
                                                <input type="text" id="name" class="form-control"
                                                       name="name" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-dismiss="modal"><i
                                                    class="fas fa-times-circle"></i></button>
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i
                                                    class="fas fa-check-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="modal fade" id="editCategory" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{route('room_category.update','test')}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Room Category</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                             <div class="input-group mb-3">
                                                 <div class="input-group-prepend">
                                                     <span class="input-group-text">Category Name</span>
                                                 </div>
                                                 <input type="text" id="categoryName" class="form-control"
                                                        name="name" required>
                                             </div>

                                            <input type="hidden" id="catId" name="id">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-dismiss="modal"><i
                                                    class="fas fa-times-circle"></i></button>
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i
                                                    class="fas fa-check-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="card">
                            <div class="card-body mt-0">
                                <div class="table-responsive">
                                    <table id="myTable"
                                           class="table table-striped table-hover table-responsive-sm table-sm">
                                        <thead class="bg-green">
                                        <tr>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{$category->name}}</td>
                                                <td class="d-inline-flex">

                                                    <button type="button" class="btn btn-sm btn-default float-right"
                                                            data-toggle="modal"
                                                            data-target="#editCategory"
                                                            data-catname="{{$category->name}}"
                                                            data-catid="{{$category->id}}">
                                                        <i class="fas fa-edit" style="color: #1abb9c"></i>
                                                    </button>

                                                    <form action="{{route('room_category.destroy',$category->id)}}"
                                                          method="post" class="form-delete"
                                                          style="display: inline-block" >
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-default" onclick="return confirm('Are you sure?');"><i
                                                                class="fas fa-trash" style="color: #dc1201"></i>
                                                        </button>
                                                    </form>
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
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();

            $('#editCategory').on('show.bs.modal', function (event) {

                var button = $(event.relatedTarget)
                var name = button.data('catname')
                var catid = button.data('catid')
                var modal = $(this)
                modal.find('.modal-body #categoryName').val(name);
                modal.find('.modal-body #catId').val(catid);
            })

        });


    </script>
@endsection
