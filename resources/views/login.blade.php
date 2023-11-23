<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Авторизация</title>

        @vite(['resources/css/main.css', 'resources/css/login.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/97d69fa06e.js" crossorigin="anonymous"></script>
     </head>
    <body>

    <!-- header comp -->
    <x-header />

        <main>
            <div class="container-fluid">
                <div class="container cont-c">
                    <div class="row">
                        <div class="col-8">
                            <div class="col-12 s-m">
                            <h3 class="header-c">Авторизация</h6>
                            <form class="form-class" method="post" action="/login/post">
                            @csrf
                                <div class="mb-3 in-c">
                                    <label for="email" class="form-label">Email: @if($errors->has('email')) {{$errors->first('email')}} @endif</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3 in-c">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                 </div>

                                <div class="mb-3 form-check ch-c">
                                    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox">
                                    <label class="form-check-label" for="checkbox">Запомнить меня</label>

                                    <br>Забыли пароль? <a href="/reset">Восстановить</a>
                                </div>

                                <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-primary btn-c">Войти</button>
                          </div>

                            </form>
                            </div>
                            <div class="col-12 in-cc">
                            Нет аккаунта? <a href="/register">Регистрация</a>
                            </div>
                        
                        </div>

                        <!-- rightbar comp -->
                        <x-rightbar />
                    </div>
                </div>
                
            </div>
        </main>

        <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
