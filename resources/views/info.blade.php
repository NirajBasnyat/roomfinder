Add Facilities many to many
add owner image in sidebar

Room facility and Category can only be viewed and edited by admin ->make it

https://medium.com/swlh/10-laravel-helpers-that-you-should-know-9edbb78c2b0a

maps and application section

applicant and room will have many to many relationship

user online and offline ->code inspire video
use detach in Many to many rel





<div class="container">
    {{-- comments--}}
    <div class="comments">
        <h3>comments</h3>
        <ul class="list-group list-group-flush" style="max-height: 196px; overflow-y: auto">
            @forelse($room->comments as $comment)
                <li class="list-group-item">{{$comment->body}}
                    <span class="float-right">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#comment_{{$comment->id}}">Edit</button>
                                     {{--  add comment modal--}}
                                    <div class="modal fade" id="comment_{{$comment->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="editComment" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editComment">Edit Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('room.comment_update',$comment->id)}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                               placeholder="add comment here ....."
                                                               value="{{$comment->body}}" name="body">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-green" type="submit"
                                                                    id="button-addon2">
                                                                Post comment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                </span>
                    <span class="float-right">
                                     <form action="{{route('room.comment_delete',$comment->id)}}" method="post">
                                         @csrf
                                         @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger float-right ml-3">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                   </form>
                                </span>
                    <br><br>
                    <span>
                                    By {{$comment->user->id == auth()->id() ? 'You' : $comment->user->name}}, {{$comment->created_at->diffForHumans()}}

                                    <span class="float-right">
                                    <!-- add reply modal btn -->
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#exampleModal">
                                         Reply
                                        </button>

                                        <!--add reply Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                             <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                             <div class="modal-body">
                                                 <form action="{{route('room.reply',$comment->id)}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                   placeholder="add reply here ....."
                                                                   value="{{old('body')}}" name="body">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-green" type="submit"
                                                                        id="button-addon2">Post reply
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                             </div>
                                            </div>
                                          </div>
                                        </div>

                                    </span>
                                </span>
                </li>

                @foreach($comment->comments as $reply)
                    <li class="list-group-item">{{$reply->body}}
                        <span class="float-right">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#comment_{{$comment->id}}">Edit</button>
                                     {{--  add comment modal--}}
                                    <div class="modal fade" id="comment_{{$comment->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="editComment" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editComment">Edit Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('room.comment_update',$comment->id)}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                               placeholder="add comment here ....."
                                                               value="{{$comment->body}}" name="body">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-green" type="submit"
                                                                    id="button-addon2">
                                                                Post comment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                </span>
                        <span class="float-right">
                                     <form action="{{route('room.comment_delete',$reply->id)}}" method="post">
                                         @csrf
                                         @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger float-right ml-3">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </span>
                        <br><br>

                    </li>
                @endforeach

            @empty
                <li class="list-group-item">No comments</li>
            @endforelse
        </ul>
    </div>


    {{--  add comment form--}}
    <div class="comment-form mt-3">
        <form action="{{route('room.comment',$room->id)}}" method="post">
            @csrf
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="add comment here ....."
                           value="{{old('body')}}" name="body">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-green" type="submit" id="button-addon2">Post comment
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>






