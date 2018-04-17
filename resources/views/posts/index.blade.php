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
                    <th>Update At</th>
                    <th class="text-center" width="150">
                        <button class="create-modal btn btn-success btn-sm">
                            <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </th>
                </tr>
                {{csrf_field()}}
                <?php $n = 1; ?>
                @foreach($posts as $post)
                    <tr class="post{{$post->id}}">
                        <td>{{$n++}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>
                            <button class="show-modal btn btn-info btn-sm" data-id="{{$post->id}}"
                                    data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                            <button  class="edit-modal btn btn-warning btn-sm" data-id="{{$post->id}}"
                               data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                            <button class="delete-modal btn btn-danger btn-sm" data-id="{{$post->id}}"
                               data-title="{{$post->title}}" data-body="{{$post->body}}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{$posts->links()}}
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
                                <div class="error text-danger"></div>
                            </div>
                        </div>

                        <div class="form-group row add">
                            <label class="control-label col-sm-2" for="body">Body :</label>
                            <div class="col-sm-10">
                                <input type="text" name="body" class="form-control" id="body"
                                       placeholder="Your Body Here" required>
                                <div class="error text-danger"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="button" id="add">
                        <span class="glyphicon glyphicon-plus"></span> Save Post
                    </button>
                    <button class="btn btn-dark" type="button" name="button" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>

            </div>
        </div>
    </div>


    {{--Form Edit and Delete--}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="t">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="body" id="b" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </form>

                    {{--Form Delete POST--}}
                    <div class="delete-content">
                        Are You sure want to delete post - <span class="title text-uppercase"></span> ?
                        <span class="hidden id"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn btn-success" data-dismiss="modal">
                        <span id="footer_action_button" class="glyphicon"></span>
                    </button>

                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>

            </div>
        </div>
    </div>


    {{--Modal Form Show Post--}}
    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ID :</label>
                        <b id="i"/>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Title :</label>
                        <b id="ti"/>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Body :</label>
                        <b id="by"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

