<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Регистрация</title>

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
                            <h3 class="header-c">Регистрация</h6>
                            <form class="form-class" action="/register/post" method="post">
                            @csrf
                                <div class="mb-3 in-c">
                                    <label for="email" class="form-label">
                                        Email: @if($errors->has('email')) {{$errors->first('email')}} @endif 
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3 in-c">
                                    <label for="name" class="form-label">
                                        Имя: @if($errors->has('name')) {{$errors->first('name')}} @endif 
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3 in-c">
                                    <label for="password" class="form-label">
                                        Пароль: @if($errors->has('password')) {{$errors->first('password')}} @endif 
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password">
                                 </div>

                                 <div class="mb-3 in-c">
                                    <label for="password2" class="form-label">
                                        Повторить пароль: @if($errors->has('password2')) {{$errors->first('password2')}} @endif 
                                    </label>
                                    <input type="password" class="form-control" id="password2" name="password2">
                                 </div>

                                <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-primary btn-c">Регистрация</button>
                          </div>

                            </form>
                            </div>
                            <div class="col-12 in-cc">
                            Есть аккаунт? <a href="/login">Авторизация</a>
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
