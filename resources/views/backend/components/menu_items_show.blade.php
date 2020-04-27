@section('content')
    <h4>{{$menu['name']}} (menu items)</h4>
    <div class="max-height-var" style="--max-height:70vh">

    <ul class="columns-var" style="--columns:2">
        @foreach($items as $item)
            <li><a href="{{route('load_menu_item', $item['id'])}}" target="_blank">{{ $item['label'] }}</a></li>
        @endforeach
    </ul>
    </div>
@endsection
