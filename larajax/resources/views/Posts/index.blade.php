@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h4>Posts</h4>
        </header>

        <div class="row">
            <div id="success" class="col-6 m-auto">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-sm-12 mb-1">
                <input class="form-control opacity-50" id="myInput" type="text" placeholder="Search Table">
            </div>

            <div class="col-lg-2 col-sm-12 mb-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo">Add new post</button>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Post Title</th>
                                <th scope="col">Post Description</th>
                                <th scope="col">At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableData" class="cont-data">
                            {{-- Start Fetch Data --}}
                            @foreach ($posts as $post)
                                <tr    id={{$post->id}}>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td style="max-width: 50px">{{ $post->title }}</td>
                                    <td style="max-width: 100px">{{ $post->desc }}</td>
                                    <td style="max-width: 30px">
                                        <strong>
                                            {{ $post->updated_at->diffForHumans() }}
                                        </strong>
                                    </td>
                                    <td style="max-width: 70px">
                                        <button type="button" post_id ={{$post->id}} class="btn btn-dark btn-sm edit-post" data-route={{route('edit.post' , $post->id)}} data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo">Edit</button>
                                        <a class="btn btn-sm btn-danger text-white delete-post" data-route="{{route('delete.post' , $post->id)}}">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            {{-- End Fetch Data --}}
                        </tbody>
                        <tfoot>
                            <div class="d-flex justify-content-center">
                                {{ $posts->appends(request()->input())->links() }}
                            </div>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>



{{-- Add Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="errors">
                        {{-- <li class="text-danger">any thing</li> --}}
                    </ul>
                    <form id="addPost">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="desc" id="desc"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="e_errors">
                        {{-- <li class="text-danger">any thing</li> --}}
                    </ul>
                    <form id="editPost">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="title" id="e_title">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="desc" id="e_desc"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


{{-- Ajax Start --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('js/post.js')}}"></script>



@endsection
