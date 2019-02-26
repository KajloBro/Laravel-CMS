<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">

    <title>Blog Post - Start Bootstrap Template</title>

</head>

<body class="pt-0">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Home</a>
        </div> <!-- /.navbar-header -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                @yield('content')
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer style="background-color: #ddd">
            <div class="row text-center">
                <div class="col-lg-12">
                    <p>Copyright &copy; CodeHacking by Dodo 2019</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/libs.js')}}"></script>
    @yield('scripts')
</body>

</html>
