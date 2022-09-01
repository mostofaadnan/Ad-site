
<div class="location-city-box">
    <div class="grid row">
        @foreach($usallists as $list)
        @if(Count($list->CityList))
        <div class="grid-item col-sm-4">
        <h5><a href="{{ route('AdCategorys',$list->id) }}" class="city-name">{{ $list->name  }}</a></h5>
            <div class="state-name">
                <ul>
                    @foreach($list->CityList as $city)
                    <li class="mx-auto"><a href="{{ route('AdCategorys',$city->id) }}">{{ $city->name }}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
        @endif
        @endforeach
    </div>
</div>
