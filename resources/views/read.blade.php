<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$post->title}}</title>

        @vite(['resources/css/main.css', 'resources/css/read.css'])
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
                                <h3 class="head-main">{{$post->title}}</h6>
                                <div class="d-flex st-m-l s-a">
                                    <div class="col-6">
                                    {{ date("d.m.Y",strtotime("$post->date")) }}
                                    </div>
                                    <div class="col-6">
                                    Автор: Егор
                                    </div>
                                </div>
                            </div>
                            {!! $post->post !!}

                            <div class="col-12">
                            <div class="d-flex justify-content-center">
                                    <form data-action="/like" id="likeForm{{$post->id}}">
                                    @csrf
                                     
                                    <p class="like-amount" id="amount{{$post->id}}">{{ $post->likes }}</p>

                                    
                                     
                                     
                                    @if(Auth::check())
                                    @php($userLikes = explode(",", Auth::user()->likes))
                                        @if(in_array($post->id, $userLikes))
                                            <button type="submit" id="submitlike{{$post->id}}" class="like-liked"><i class="fa-solid fa-heart"></i></button>
                                            @else
                                           <button type="submit" id="submitlike{{$post->id}}" class="like"><i class="fa-solid fa-heart"></i></button>
                                           @endif
                                    @else
                                        <button type="submit" class="like"><i class="fa-solid fa-heart"></i></button>
                                    @endif
                                    </form>
                                </div>
                                <hr>
                                <h2 class="header-c">Статьи из этой категории</h2>
                            </div>

                            <div class="container">
                            <div class="row">
                            @foreach ($random as $randomPost)
                            <div class="col-6">
                            <a href="/read/{{$randomPost->id}}">
                            <h5><a href="/read/{{$randomPost->id}}" class="h-h-rand truncate-text">{{$randomPost->title}}</a></h5>
                                        <img src="{{$randomPost->image}}" 
                                        class="st-i-rand2" alt="">
                                    </a>

                            </div>
                            @endforeach
                            </div>
                            </div>
                            <hr>
                            <div id="comments" class="col-12 padding-comment">
                                <h4 class="padding-comment">Комментарии</h4>

                                @php( $commnets=DB::table('comments')->where('postid', $post->id)->orderBy('id')->get())
                                @if(count($commnets) == 0)
                                <div class="col-12 comment" id="nocomment">
                                    Комментарии отсутствуют
                                </div>
                                @else
                                @foreach($commnets as $com)

                                <div class="d-flex">
                                <div class="col-6">
                                <div class="badge bg-secondary text-size">
                                    {{$com->name}}
                                </div>
                                    </div>
                                    <div class="col-6">
                                    {{ date("d.m.Y H:i",strtotime("$com->date")) }}
                                    </div>
                                </div>
                                <div class="col-12 comment">
                                    {{$com->comment}}
                                </div>
                                <hr>
                                @endforeach
                                @endif
                            </div>

                            <div class="col-12 margin-comment">
                                <h4 class="padding-comment" id="headerComment">Добавить комментарий</h4>
                                <form class="padding-comment" id="addcomment" data-action="/addcomment">
                                    <div class="form-group"> 
                                    <textarea class="form-control" id="commentText" name="comment" rows="3"></textarea>
                                    </div>
                                    <input type="hidden" id="postid" value="{{$post->id}}">
                                    <button type="submit" id="addcomment" class="btn btn-primary b-p margin-comment">Комментировать</button>
                                </form>
                            </div>
                        
                        </div>
                        <x-rightbar />
                    </div>
                </div>
                
            </div>
        </main>

        <script>
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('form[id^="likeForm"]').on('submit',function(event){
           
           event.preventDefault();      
           var url = $(this).attr('data-action');
           var id = this.id.replace(/likeForm/, '');
           var amount = $('#amount'+id).html();
           $.ajax({
               url: url,
               method:"POST",
               data:{
                  id:id,
                  amount:amount
               },
               success:function(response){
                   $('#amount' + id).text(response.likes)
                   $('#submitlike' + id).removeClass();
                   $('#submitlike' + id).addClass(response.class);
               },
            });
       });

       $('#addcomment').on('submit',function(event){
           
           event.preventDefault();
           var url = $(this).attr('data-action');
           var id = $('#postid').val();
           var comment = $('#commentText').val();

           $.ajax({
               url: url,
               method:"POST",
               data:{
                  id:id,
                  comment:comment
               },
               success:function(response){
                console.log(response);
                   if(response.error)
                   {
                        $('#headerComment').text('Добавить комментарий')
                        $('#headerComment').append('<br><div class="badge bg-danger text-size2">' + response.error + '!</div>')
                   }
                   else
                   {
                        if($('#nocomment'))
                            $('#nocomment').remove();

                        $('#headerComment').text(' ');
                        $('#headerComment').text('Добавить комментарий');
                        $('#comments').append('<div class="d-flex"> <div class="col-6"> <div class="badge bg-secondary text-size">'+ response.name + '</div> </div> <div class="col-6"> '+ response.date + ' </div> </div> <div class="col-12 comment">'+ response.comment + '</div> <hr>')
                   }
   
               },
               error: function(xhr, status, error) {
        console.log(xhr.responseText);
        console.log(status);
        console.log(error);
    }
            });

       });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
