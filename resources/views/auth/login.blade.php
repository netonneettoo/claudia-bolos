@extends('layouts.admin_login')

@section('content')
    <div>
        <div>
            <h1 class="logo-name">IN+</h1>
        </div>
        <h3>Welcome to IN+</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" action="/auth/login" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Senha" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
@endsection