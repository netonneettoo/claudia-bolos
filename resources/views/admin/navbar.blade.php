<?php
    $navItems = [
            ['href' => '/admin', 'icon' => 'fa fa-th-large', 'text' => 'Página Principal'],
            ['href' => '/admin/cake-requests', 'icon' => 'fa fa-th-large', 'text' => 'Pedidos'],
    ];
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                                </span>
                                <span class="text-muted text-xs block">{{ \Illuminate\Support\Facades\Auth::user()->email }} <b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="/auth/logout">Sair</a></li>
                        </ul>
                    </span>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            @foreach($navItems as $item)
                <li>
                    <a href="{{$item['href']}}"><i class="{{$item['icon']}}"></i> <span class="nav-label">{{$item['text']}}</span></a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>