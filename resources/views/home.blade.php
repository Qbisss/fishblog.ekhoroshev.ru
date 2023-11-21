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
                                @foreach ($posts as $post)
                                <h3 class="st-m-l"><a href="/read/{{$post->id}}" class="h-h">{{$post->title}}</a></h3>
                                <div class="d-flex st-m-l s-a">
                                    <div class="col-6">
                                    {{ date("d.m.Y",strtotime("$post->date")) }}
                                    </div>
                                    <div class="col-6">
                                    Автор: {{$post->name}}
                                    </div>
                                </div>
                                    <a href="/read/{{$post->id}}">
                                        <img src="{{$post->image}}" 
                                        class="st-i" alt="">
                                    </a>
                                <p class="st-a">
                                {{$post->info}}
                                </p>
                                <div class="d-flex justify-content-between st-m-l">
                                <div class="d-flex">
                                    <a href="/read/{{$post->id}}" class="r-n">Читать полностью</a>
                                </div>
                                <div class="d-flex">
                                    <form data-action="like" id="likeForm{{$post->id}}">
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
                                </div>

                                @endforeach
                            </div>
                        
                        </div>

                        <!-- rightbar comp -->
                        <x-rightbar />
                    </div>
                </div>
                
            </div>
        </main>

        <footer>

        </footer>

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
                    console.log(response);
                    $('#amount' + id).text(response.likes)
                    $('#submitlike' + id).removeClass();
                    $('#submitlike' + id).addClass(response.class);
                },
             });
        });
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
