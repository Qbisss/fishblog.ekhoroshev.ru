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
                            <h3 class="header-c">Вы успешно сменили пароль</h3>
                            </div>
                        <!-- rightbar comp -->
                        </div>
                        <x-rightbar />
                </div>
            </div>
        </main>

        <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
