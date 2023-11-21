<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Личный кабинет</title>

        @vite(['resources/css/main.css', 'resources/css/personal.css'])
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
                            <div class="col-12">
                            <h3 class="header-c">Ваши посты на проверке</h3>
                            </div>
                            <div class="col-12 in-cc">
                            <a href="/personal/publish">Опубликованные</a>
                            <a href="/personal/check">На рассмотрение</a>
                            </div>

                            <table class="table">

                            <thead>
                                <tr>
                                <th scope="col">Дата</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Заголовок</th>
                                <th scope="col">Статус</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                <td>{{ $post->date }}</td>
                                <td>{{ $post->category }}</td>
                                <td>{{ $post->title }}</td>
                                @if($post->status == 'edit')
                                <td>
                                <a href="/edit/{{$post->id}}" data-toggle="tooltip" title="{{$post->note}}">Требует правок</a>    
                                </td>
                                @else
                                <td>На проверке</td>
                                @endif
                                </tr>
                            @endforeach
                            </tbody>

                            </table>    
                        </div>
                        

                        <!-- rightbar comp -->
                        <x-rightbar />
                </div>
            </div>
        </main>

        <footer>

        </footer>
        <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
