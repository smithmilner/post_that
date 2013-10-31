<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Post That</title>
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::script('ckeditor/ckeditor.js') }}
</head>
<body>

@include('_partials.navigation')

<div class="container" style="margin-top:90px">
    <div class="row">

        @include('_partials.messages')

        <div class="col-md-8">

            @yield('content')

        </div>
        <div class="col-md-4">

            @section('sidebar')
            @show

        </div>
    </div>
</div>
    
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/bootstrap.js') }}

</body>
</html>