<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h4 class="footer-heading">{{ \App\Option::ValueByKey('Footer Title') }}</h4>
                {!! \App\Option::ValueByKey('Footer Description') !!}

            </div>
            <div class="col-sm-12 col-md-6">
                <div class="row">
                    @foreach(App\Menu::where('name','!=','Main')->get() as $menu)
                        <div class="col-sm-6 col-md-4">
                            <h4 class="footer-heading">{{$menu->name}}</h4>
                            <ul class="footer-links">
                                @foreach($menu->items as $menuItem)
                                    <li>
                                        <a href="{{route('load_menu_item', $menuItem)}}" class="text-capitalize">
                                            <span class="icon icon-angle-right"></span>
                                            {{ $menuItem->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <p>Copyright &copy; <?php echo date("Y"); ?> <a href="{{ route('landing') }}" target="_blank">Inatrend Kenya</a>
        </p>
        <p>(temporary quick setup for admin)
            <a href="{{ route('prepare_dummy') }}" class="btn btn-sm btn-danger">Setup Dummy</a> <a
                href="{{ route('delete_dummy') }}" class="btn btn-sm btn-danger">Delete Dummy</a></p>
    </div>
</div>
