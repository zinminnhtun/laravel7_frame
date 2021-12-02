@if(session('status'))
    {!! session('status') !!}
@endif
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created at</th>
    </tr>
    </thead>
    <tbody>
    @forelse(\App\Category::with('user')->orderByDesc('id')->get() as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>
                @isset($category->user)
                    {{ $category->user->name }}
                @endisset
            </td>
            <td>
                                    <span class="d-flex justify-content-around align-items-center">
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
{{--                                        <div class="btn btn-outline-danger btn-sm" onclick="if (confirm('Are you sure to delete {{ '"'.$category->title.'"' }}?')){event.preventDefault();document.getElementById('delete-category{{$category->id}}').submit()};">--}}
{{--                                            <i class="fas fa-trash-alt fa-fw"></i>--}}
{{--                                        </div>--}}

                                    </span>
                <form action="{{ route('category.destroy',$category->id) }}" id="delete-category{{$category->id}}" method="post">
                    @csrf
                    @method('delete')
                </form>
            </td>
            <td class="text-wrap">
                <span class="text-nowrap"><i class="fas fa-calendar-alt"></i> {{ $category->created_at->format("d-m-Y") }}</span>
                <br>
                <span class="text-nowrap"><i
                        class="fas fa-clock"></i> {{ $category->created_at->format("h:i a") }}</span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">There is no category</td>
        </tr>
    @endforelse
    </tbody>
</table>
