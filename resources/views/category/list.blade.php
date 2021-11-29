@if(session('addTitle'))
    <p class="alert alert-success">{!! session('addTitle') !!}</p>
@elseif(session('updateTitle'))
    <p class="alert alert-success"> {!! session('updateTitle') !!}</p>
@elseif(session('deleteTitle'))
    <p class="alert alert-danger"> {!! session('deleteTitle') !!}</p>
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
    @foreach(\App\Category::with('user')->orderByDesc('id')->get() as $category)
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
                                        <a href="{{ route('category.edit',$category->id) }}"><i
                                                class="fas fa-edit fa-fw"></i>
                                        </a>
                                        <span class="" onclick="event.preventDefault();document.getElementById('delete-category').submit();">
                                            <i class="fas fa-trash-alt fa-fw text-danger"></i>
                                        </span>

                                    </span>
                <form action="{{ route('category.destroy',$category->id) }}" id="delete-category" method="post">
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
    @endforeach
    </tbody>
</table>
