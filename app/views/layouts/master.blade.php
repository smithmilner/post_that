<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Post That</title>
    {{ HTML::style('css/bootstrap.css') }}

</head>
<body>

@include('_partials.navigation')

<div class="container" style="margin-top:90px">
    <div class="row">

        @include('_partials.messages')

        <div class="col-md-12">

            @yield('content')

        </div>
    </div>
</div>
    
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/bootstrap.js') }}

</body>
</html>