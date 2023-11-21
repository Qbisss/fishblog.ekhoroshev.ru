<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Написать статью</title>

        @vite(['resources/css/main.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/97d69fa06e.js" crossorigin="anonymous"></script>
        <x-head.tinymce-config/>
     </head>
    <body>
    <x-header />
    
        <main>
            <div class="container-fluid">
                <div class="container cont-c">
                    <div class="row">
                        <h3>Правки вашей статьи</a></h3>
                        <form method="post" action="/republish">
@csrf
<input type="hidden" name="id" value="{{$post->id}}">
<label for="header" class="form-label">
    Заголовок 
    @if($errors->has('header'))
    : {{$errors->first('header')}}
    @endif 
</label>

  <input type="text" value="{{$post->title}}" class="form-control" id="header" name="header">
  
  <label for="info" class="form-label">
    Краткая информация
    @if($errors->has('info'))
    : {{$errors->first('info')}}
    @endif        
</label>
  <input type="text" value="{{$post->info}}" class="form-control" id="info" name="info">

  <label for="image" class="form-label">
    Ссылка на картинку
    @if($errors->has('image'))
    : {{$errors->first('image')}}
    @endif        
</label>
  <input type="text" value="{{$post->image}}" class="form-control" id="image" name="image">

  <label for="category" class="form-label">
  Категория     
</label>
  <select class="form-select" id="category" name="category">
  <option value="spin">Спиннинг</option>
  <option value="feeder">Фидер</option>
  <option value="float">Поплавок</option>
</select>

    @if($errors->has('editor'))
    Ошибка в статье: {{$errors->first('editor')}}
    @endif 

  <textarea class="t-a-m" id="myeditorinstance" name="editor">{{$post->post}}</textarea>
  <button class="btn btn-primary b-p">Отправить на проверку</button>
</form>
                    </div>
                </div>               
            </div>
        </main>

        <footer>

        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
