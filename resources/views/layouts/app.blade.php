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
    {{-- Ajax Form Add--}}

    $(document).on('click', '.create-modal', function () {
        $('#create').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Add Post');
    });

    // function Add(Save)
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
    });


</script>
</body>
</html>