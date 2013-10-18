<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Test</title>
    {{ HTML::style('css/bootstrap.css') }}

</head>
<body>
<nav class="navbar-wrapper navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Post That</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">

                <li>{{ HTML::rawLink('/', '<span class="glyphicon glyphicon-home"></span> Home') }}</li>
                @if(Auth::check())
                <li>{{ HTML::rawLink('admin', '<span class="glyphicon glyphicon-list"></span> Admin') }}</li>
                <li>{{ HTML::rawLinkRoute('posts.index', '<span class="glyphicon glyphicon-book"></span> Posts') }}</li>
                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if(!Auth::check())
                <li>{{ HTML::rawLink('login', '<span class="glyphicon glyphicon-user"></span> Login') }}</li>
                <li>{{ HTML::rawLink('register', '<span class="glyphicon glyphicon-plus"></span> Register') }}</li>
                @else
                <li>{{ HTML::rawLink('logout', '<span class="glyphicon glyphicon-remove-circle"></span> Logout'); }}</li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<div class="container" style="margin-top:90px">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>
    
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/bootstrap.js') }}
</body>
</html>