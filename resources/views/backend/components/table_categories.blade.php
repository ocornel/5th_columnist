@isset($categories)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>CREATED</th>
            <th class="text-right">VIEWS</th>
            <th class="text-right">POSTS</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td><a href="{{ route('show_category', [$category, $category->name]) }}">{{ $category->name }}</a></td>
                <td>{{ \Illuminate\Support\Str::limit($category->description, isset($character_limit)?$character_limit:50, $end='...') }}</td>
                <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y') }}</td>
                <td class="text-right">{{ number_format($category->view_count) }}</td>
                <td class="text-right">{{ number_format($category->post_count) }}</td>
                @isset($actions)
                    <td>
                        <a href="{{ route('load_category', [$category, $category->name]) }}" title="Preview"
                           class="btn-sm btn-success" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('edit_category', [$category, $category->name]) }}" title="Edit"
                           class="btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_category', [$category]) }}" title="Delete" class="btn-sm btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No Categories to include</p>
@endif
