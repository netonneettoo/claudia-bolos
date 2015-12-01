<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cláudia Bolos - Admin</title>

    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/admin/css/animate.css" rel="stylesheet">
    <link href="/assets/admin/css/style.css" rel="stylesheet">

    @yield('styles')

</head>

<body>

<div id="wrapper">

    @include('admin.navbar')

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="/auth/logout">
                            <i class="fa fa-sign-out"></i> Sair
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>

        <div class="footer">
            <div class="pull-right">
                by: <a href="http://www.walterneto.com.br"><strong>Walter Neto</strong></a>.
            </div>
            <div>
                <strong>Copyright</strong> Cláudia Bolos &copy; 2014-2015
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="/assets/admin/js/jquery-2.1.1.js"></script>
<script src="/assets/admin/js/bootstrap.min.js"></script>
<script src="/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/assets/admin/js/inspinia.js"></script>
<script src="/assets/admin/js/plugins/pace/pace.min.js"></script>

<script>
    $(document).ready(function() {
        $("#side-menu > li > a[href='" + window.location.pathname + "']").parent().addClass('active');
    });
</script>

@yield('scripts')

</body>

</html>
