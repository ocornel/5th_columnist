@isset($pages)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>TITLE</th>
            <th>CREATOR</th>
            <th>DESCRIPTION</th>
            <th>DATE CREATED</th>
            <th class="text-right">VIEWS</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td><a href="{{ route('show_page', [$page, $page->name]) }}">{{ $page->title }}</a></td>
                <td>
                    <a href="{{ route('show_user', [$page->created_by, $page->author->full_name]) }}">{{ $page->author->full_name }}</a>
                </td>
                <td>{{ \Illuminate\Support\Str::limit($page->description, isset($character_limit)?$character_limit:50, $end='...') }}</td>
                <td>{{ \Carbon\Carbon::parse($page->created_at)->format('D d/M/Y') }}</td>
                <td class="text-right">{{ number_format($page->view_count) }}</td>
                @isset($actions)
                    <td>
                        <a href="{{ route('load_page', [$page, $page->name]) }}" title="Preview" target="_blank" class="btn btn-primary"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('edit_page', [$page, $page->name]) }}" title="Edit" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_page', [$page]) }}" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Please define $pages</p>
@endif
