<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../favicon.ico">

    @yield('title')

    @include('layouts.css')
    @yield('css')



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
@include('layouts.facebook')
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laraboot</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="#about">About</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                	<ul class="dropdown-menu">
                		<li><a href="/user">Users</a></li>
                		<li><a href="/profile">Profiles</a></li>
                	</ul>
                </li>
                @endif


                <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expended="false">Content<span class="caret"></span></a>
                	<ul class="dropdown-menu">	
                		<li><a href="/widget">Widgets</a></li>
                	</ul>
                </li>
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/auth/logout">Logout</a></li>
                        <li><a href="/my-profile">My Profile</a></li>
                        <li><a href="/settings">Settings</a></li>
                        <li>
                            <a href="/auth/facebook">
                                <i class="fa fa-facebook"></i> Sync with Fb
                            </a>
                        </li>                        
                    </ul>
                </li>
                <li><img class="circ" src="{{ Gravatar::get(Auth::user()->email) }}"></li>
                @else
                <li><a href="/auth/login">Login</a></li>
                <li><a href="/auth/register">Register</a></li>
                <li>
                    <a href="/auth/facebook">
                        <i class="fa fa-facebook"></i> Sign In
                    </a>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container theme-showcase" role="main">

@yield('content')

<hr>

<div class="well">
<p>&copy;
@if (date('Y') > 2015)
2015 - {{ date('Y') }}
@else
2015
@endif
Laraboot All rights reserved
</p>
</div>


</div> <!-- /container -->


@include('layouts.scripts')
@include('Alerts::show')
@yield('scripts')

</body>
</html>