<div class="col-4">
    <div class="col-12">
        <h6>Поиск статьи</h6>
        <hr>
        <form class="d-flex" method="get" action="/search"> 
        <input class="form-control mr-2" type="search" aria-label="Search" name="search"> 
        <button class="n-bor" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button> 
        </form>
    </div>
    <div class="col-12">
        <h6 class="pr-t">Случайный пост</h6>
        <hr>
        @php
        $randomPost= DB::table('table_posts')
                ->inRandomOrder()
                ->first();
        @endphp
        <a href="/read/{{$randomPost->id}}">
                                        <img src="{{$randomPost->image}}" 
                                        class="st-i-rand" alt="">
                                    </a>

                                    <h5><a href="/read/{{$randomPost->id}}" class="h-h-rand">{{$randomPost->title}}</a></h5>
                                <div class="d-flex s-a">
                                    <div class="col-6">
                                    {{ date("d.m.Y",strtotime("$randomPost->date")) }}
                                    </div>
                                    <div class="col-6">
                                    Автор: {{$randomPost->name}}
                                    </div>
    </div>
    <div class="col-12">
        <h6 class="pr-t">Наши партнеры</h6>
        <hr>
        <ul class="pr">
            <li><a target="_blank" href="https://www.jpsnasti.ru/">Японские снасти</a></li>
            <li><a target="_blank" href="https://onlyspin.ru/">OnlySpin</a></li>
            <li><a target="_blank" href="https://rybalkashop.ru/">RybalkaShop</a></li>
        </ul>
    </div>
</div>