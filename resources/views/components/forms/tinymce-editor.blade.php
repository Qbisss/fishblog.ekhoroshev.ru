<form method="post" action="/post">
@csrf
<label for="header" class="form-label">
    Заголовок 
    @if($errors->has('header'))
    : {{$errors->first('header')}}
    @endif 
</label>

  <input type="text" class="form-control" id="header" name="header">
  
  <label for="info" class="form-label">
    Краткая информация
    @if($errors->has('info'))
    : {{$errors->first('info')}}
    @endif        
</label>
  <input type="text" class="form-control" id="info" name="info">

  <label for="image" class="form-label">
    Ссылка на картинку
    @if($errors->has('image'))
    : {{$errors->first('image')}}
    @endif        
</label>
  <input type="text" class="form-control" id="image" name="image">

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

  <textarea class="t-a-m" id="myeditorinstance" name="editor">Содержание статьи</textarea>
  <button class="btn btn-primary b-p">Отправить на проверку</button>
</form>