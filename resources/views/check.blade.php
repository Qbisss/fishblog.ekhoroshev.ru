<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Проверка статьи #{{$post->id}}</title>

        @vite(['resources/css/main.css', 'resources/css/read.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/97d69fa06e.js" crossorigin="anonymous"></script>
     </head>
    <body>
    <x-header />

        <main>
            <div class="container-fluid">
                <div class="container cont-c">
                    <div class="row">
                        <div class="col-8">
                            <div class="col-12 s-m">
                                <h3 class="head-main">{{$post->title}}</h3>
                                <h6 class="head-main">{{$post->info}}</h6>
                                <div class="d-flex st-m-l s-a">
                                    <div class="col-6">
                                    Дата: {{ $post->date }}
                                    Категория: {{ $post->category }}
                                    </div>
                                    <div class="col-6">
                                    Автор: {{ $post->name }}
                                    Email: {{ $post->email }}
                                    </div>
                                </div>

                                <img src="{{$post->image}}" class="st-i" alt="">
                            </div>
                            {!! $post->post !!}
                            <form method="post" action="/publish/{{$post->id}}">
                            @csrf
                            <label for="category" class="form-label">
                            Действие     
                                </label>
                                <select class="form-select" id="category" name="do">
                                <option value="acces">Опубликовать</option>
                                <option value="remove">Удалить</option>
                                <option value="edit">Доработать</option>
                                </select>

                                <div class="mb-3">
                                    <label for="info" class="form-label">Замечание</label>
                                    <textarea class="form-control" id="info" name="info" rows="3"></textarea>
                                </div>
                                <button class="btn btn-primary b-p">Выполнить</button>
                        </form>
                        </div>
                        
                        <x-rightbar />
                    </div>
                </div>
                
            </div>
        </main>

        <footer>

        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
