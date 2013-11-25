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
                @if(Sentry::check())
                <li>{{ HTML::rawLink('admin', '<span class="glyphicon glyphicon-list"></span> Admin') }}</li>
                <li>{{ HTML::rawLinkRoute('posts.index', '<span class="glyphicon glyphicon-book"></span> Posts') }}</li>
                <li>{{ HTML::rawLinkRoute('users.index', '<span class="glyphicon glyphicon-user"></span> Users') }}</li>
                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if(!Sentry::check())
                <li>{{ HTML::rawLink('login', '<span class="glyphicon glyphicon-user"></span> Login') }}</li>
                <li>{{ HTML::rawLink('register', '<span class="glyphicon glyphicon-plus"></span> Register') }}</li>
                @else
                <li>{{ HTML::rawLink('logout', '<span class="glyphicon glyphicon-remove-circle"></span> Logout'); }}</li>
                @endif

            </ul>
        </div>
    </div>
</nav>