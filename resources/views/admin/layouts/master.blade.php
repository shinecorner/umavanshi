<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminex.themebucket.net/horizontal_menu.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 14 May 2014 08:18:36 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>Horizontal menu Page</title>

  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/style-responsive.css" rel="stylesheet">
  @stack('stylesheets')
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/js/html5shiv.js"></script>
  <script src="/js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="horizontal-menu-page">

<section>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="/images/logo.png" alt="">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li ><a href="{{route('homepage')}}">{{__('Dashboard')}}</a></li>                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('Labour')}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a alt="{{__('Wax')}}" title="{{__('Wax')}}" href="{{route('wax_labour_list')}}">{{__('Wax')}}</a></li>                            
                            <li><a alt="{{__('Casting')}}" title="{{__('Casting')}}" href="{{route('casting_labour_list')}}">{{__('Casting')}}</a></li>
                            <li><a alt="{{__('Nachak')}}" title="{{__('Nachak')}}" href="{{route('nachak_labour_list')}}">{{__('Nachak')}}</a></li>
                            <li><a alt="{{__('Jaboro')}}" title="{{__('Jaboro')}}" href="{{route('jaboro_labour_list')}}">{{__('Jaboro')}}</a></li>
                            <li><a alt="{{__('Drum')}}" title="{{__('Drum')}}" href="{{route('drum_labour_list')}}">{{__('Drum')}}</a></li>
                            <li><a alt="{{__('Revavu')}}" title="{{__('Revavu')}}" href="{{route('rev_labour_list')}}">{{__('Revavu')}}</a></li>
                            <li><a alt="{{__('Dull')}}" title="{{__('Dull')}}" href="{{route('dull_labour_list')}}">{{__('Dull')}}</a></li>                            
                            <li><a alt="{{__('Chholkam')}}" title="{{__('Chholkam')}}" href="{{route('chholkam_labour_list')}}">{{__('Chholkam')}}</a></li>
                            <li><a alt="{{__('Gold')}}" title="{{__('Gold')}}" href="{{route('gold_labour_list')}}">{{__('Gold')}}</a></li>
                            <li><a alt="{{__('Diamond Seating')}}" title="{{__('Diamond Seating')}}" href="{{route('dimond_labour_list')}}">{{__('Diamond Seating')}}</a></li>
                            <li><a alt="{{__('Mino')}}" title="{{__('Mino')}}" href="{{route('mino_labour_list')}}">{{__('Mino')}}</a></li>
                            <li><a alt="{{__('Packing')}}" title="{{__('Packing')}}" href="{{route('packing_labour_list')}}">{{__('Packing')}}</a></li>
                        </ul>
                    </li>                    
                </ul>

                <ul class="nav navbar-nav navbar-right">                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <img alt="" src="/images/photos/user-avatar.png"> 
                            {{session('user_full_name', 'Admin')}}
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


   @yield('content')

    <!--footer section start-->
    <footer class="sticky-footer">
        Footer contents goes here
    </footer>
    <!--footer section end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/js/jquery-1.10.2.min.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/modernizr.min.js"></script>
<script src="/js/jquery.nicescroll.js"></script>

<!--common scripts for all pages-->
<script src="/js/scripts.js"></script>
<script type="text/javascript">
    $(function () {
        $('.fade').fadeOut('slow');
    });
</script>
@stack('scripts')
</body>

<!-- Mirrored from adminex.themebucket.net/horizontal_menu.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 14 May 2014 08:18:36 GMT -->
</html>
