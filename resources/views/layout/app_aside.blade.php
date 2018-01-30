<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light" style="position:fixed;">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="{{ url('/user/myUser') }}">
                        <img class="img-responsive" src="{{ asset('assets/images/user_icon.png') }}" alt="avatar" />
                    </a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5>
                        <a href="{{ route('editMyUser') }}" class="username">
                            {{ Auth::user()->name }}
                        </a>
                    </h5>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                @if(Auth::user()->level == 'admin')
                    <li class="has-submenu">
                        <a class="submenu-toggle">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span class="menu-text">Categorias</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('categorie_new') }}">
                                    <span class="menu-text">Agregar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categorie_list') }}">
                                    <span class="menu-text">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-file-text"></i>
                            <span class="menu-text">Pruebas</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('new_create') }}">
                                    <span class="menu-text">Agregar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('quiz_list') }}">
                                    <span class="menu-text">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-graduation-cap"></i>
                            <span class="menu-text">Especialista</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('new_specialist') }}">
                                    <span class="menu-text">Agregar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('list_specialist') }}">
                                    <span class="menu-text">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-check-square-o"></i>
                            <span class="menu-text">Resultados</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('results.index') }}"><span class="menu-text">Lista</span></a></li>
                        </ul>
                    </li>
                @if(Auth::user()->level == 'admin')
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Usuarios</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('user_list') }}"><span class="menu-text">Lista</span></a></li>
                        </ul>
                    </li>
                    <li class="menu-separator"><hr></li>
                @endif
                    <li>
                        <a href="{{ route('logout_user') }}">
                            <i class="menu-icon fa fa-sign-out"></i>
                            <span class="menu-text">Salir</span>
                        </a>
                    </li>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->
