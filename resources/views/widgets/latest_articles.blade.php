@if(count($data)>0)

    <div class="widget pull-left posts-widget">
        <h4>Недавние статьи</h4>
        @foreach($data as $item)
            <a href="#">
                <div class="media-object media-object-post">
                    @if(!empty($item->icon) )
                        <img class="image" src="/{{$item->icon}}" alt=""/>
                    @else
                        <img class="image" src="/images/article.png" alt=""/>
                    @endif
                    <div class="body">
                        <a href="/article/{{$item->alias}}" style="font-weight: bold">{{$item->name}}</a>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif