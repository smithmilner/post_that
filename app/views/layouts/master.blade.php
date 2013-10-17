<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Test</title>
    {{ HTML::style('css/bootstrap.css') }}

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Posts</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>{{ HTML::link('posts', 'Posts') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:50px">
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/bootstrap.js') }}
</body>
</html>