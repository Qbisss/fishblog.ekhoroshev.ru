<header>
        <div class="container-fluid">
                <div class="container cont-c">
                    <div class="row align-items-center">
                        <div class="d-flex">
                        <div class="col-4 text-start h-n">
                            <a href="/">
                            <h4 class="fw-bold text-c">Блог о рыбалке</h4>
                            <p class="text-p">рыбачь вместе с нами</p>
                            </a>
                        </div>
                        
                        <div class="col-4 h-s">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fa-brands fa-vk vk"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-telegram tel"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-odnoklassniki ok"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube yt"></i></a></li>
                                </ul>
                        </div>
                        <div class="col-4">
                            <div class="p">
                                
                                @php
                                    $auth = \Illuminate\Support\Facades\Auth::check();
                                @endphp
                                
                                @if($auth)
                                @if(App\Http\Controllers\AuthController::check_admin())
                                    <a href="/admin" class="adm">Админка <i class="fa-solid fa-hammer"></i></a>
                                @endif
                                <a href="/personal" class="lk">Личный кабинет <i class="fa-solid fa-person"></i></a> 
                                <a href="/logout" class="exit">Выйти <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                                
                                @else
                                <a href="/login" class="lk">Авторизоваться <i class="fa-solid fa-right-to-bracket"></i></a>
                              
                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="col-12 no-p">
                            <nav class="header-nav">
                                <ul>
                                    <li>
                                        <a href="/">Главная</a>
                                    </li>
                                    <li>
                                        <a href="/spin">Спиннинг</a>
                                    </li>
                                    <li>
                                        <a href="/feeder">Фидер</a>
                                    </li>
                                    <li>
                                        <a href="/float">Поплавок</a>
                                    </li>
                                    <li>
                                        <a href="/write">Написать статью</a>
                                    </li>                                  
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>