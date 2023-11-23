<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Блог о рыбалке</title>

        @vite(['resources/css/main.css'])
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
                            <h3 class="header-c">Восстановление пароля</h6>
                            <form class="form-class" method="post" action="/reset/post">
                            @csrf
                                <div class="mb-3 in-c">
                                    <label for="email" class="form-label">Email: @if($errors->has('email')) {{$errors->first('email')}} @endif</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-primary btn-c">Восстановить</button>
                                 </div>

                            </form>
                        
                        </div>

                       
                    </div>
                     <!-- rightbar comp -->
                     <x-rightbar />
                </div>
                
            </div>
        </main>

        <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
