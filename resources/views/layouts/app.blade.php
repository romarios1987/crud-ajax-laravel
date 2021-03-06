<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('posts.index')}}">CRUD</a>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>


<script>

    //--------------------------- form Add function ---------------------//
    $(document).on('click', '.create-modal', function () {
        $('#create').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Add Post');
    });
    $('#add').click(function () {
        $.ajax({
            type: 'post',
            url: 'addPost',
            data: {
                '_token': $('input[name=_token]').val(),
                'title': $('input[name=title]').val(),
                'body': $('input[name=body]').val(),
            },

            success: function (data) {
                if (data.errors) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.title);
                    $('.error').text(data.errors.body);
                } else {

                    $('.error').remove();
                    $('#table').append("<tr class='post" + data.id + "'>" +
                        "<td>" + data.id + "</td>" +
                        "<td>" + data.title + "</td>" +
                        "<td>" + data.body + "</td>" +
                        "<td>" + data.created_at + "</td>" +
                        "<td>" + data.updated_at + "</td>" +
                        "<td>" +
                        "<button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-eye-open'></span></button> " +
                        "<button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button>" +
                        "<button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                        "</td>" +
                        "</tr>");
                }
            }
        });

        $('#title').val('');
        $('#body').val('');
        $('#create').modal('hide');
    });


    //--------------------------- form Edit function ---------------------//
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text(" Update Post");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Post Edit');
        $('.delete-content').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#t').val($(this).data('title'));
        $('#b').val($(this).data('body'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'POST',
            url: 'editPost',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'title': $('#t').val(),
                'body': $('#b').val()
            },
            success: function (data) {
                $('.post' + data.id).replaceWith(" " +
                    "<tr class='post" + data.id + "'>" +
                    "<td>" + data.id + "</td>" +
                    "<td>" + data.title + "</td>" +
                    "<td>" + data.body + "</td>" +
                    "<td>" + data.created_at + "</td>" +
                    "<td>" + data.updated_at + "</td>" +
                    "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-eye-open'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>" +
                    "</tr>");
            }
        });
    });


    //--------------------------- form Delete function ---------------------//
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete Post');
        $('.id').text($(this).data('id'));
        $('.delete-content').show();
        $('.form-horizontal').hide();
        $('.title').html($(this).data('title'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function(){
        $.ajax({
            type: 'POST',
            url: 'deletePost',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.id').text()
            },
            success: function(data){
                $('.post' + $('.id').text()).remove();
            }
        });
    });

    // Show function
    $(document).on('click', '.show-modal', function() {
        $('#show').modal('show');
        $('#i').text($(this).data('id'));
        $('#ti').text($(this).data('title'));
        $('#by').text($(this).data('body'));
        $('.modal-title').text('Show Post');
    });

</script>
</body>
</html>