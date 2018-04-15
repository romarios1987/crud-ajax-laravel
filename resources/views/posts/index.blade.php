@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Simple Laravel CRUD Ajax</h1>
        </div>
    </div>

    <div class="row">
        <div class="table table-responsive">
            <table class="table table-bordered" id="table">
                <tr>
                    <th width="150">№</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Create At</th>
                    <th class="text-center" width="150">
                        <a href="#" class="create-modal btn btn-success btn-sm">
                            <i class="glyphicon glyphicon-plus"></i>
                        </a>
                    </th>
                </tr>
                {{csrf_field()}}
                <?php $n = 1; ?>
                @foreach($posts as $post)
                    <tr class="post{{$post->id}}">
                        <td>{{$no++}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$post->id}}"
                               data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$post->id}}"
                               data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$post->id}}"
                               data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{-- Form Create Post--}}

    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group row add">
                            <label class="control-label col-sm-2" for="title">Title :</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title"
                                       placeholder="Your Title Here" required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group row add">
                            <label class="control-label col-sm-2" for="body">Body :</label>
                            <div class="col-sm-10">
                                <input type="text" name="body" class="form-control" id="body"
                                       placeholder="Your Body Here" required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="submit" name="button" id="add">
                        <span class="glyphicon glyphicon-plus"></span>Save Post
                    </button>


                    <button class="btn btn-warning" type="button" name="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Close
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection

