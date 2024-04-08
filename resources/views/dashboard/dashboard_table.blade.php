<x-layouts.dashboard>
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            @if(request()->is('dashboard/professors'))
                <h1 class="h2">Викладачі</h1>
            @endif
            @if(request()->is('dashboard/professors'))
                <form role="search">
                    <input class="form-control" type="search" name="dashboard_search" placeholder="Search"
                           aria-label="Search">
                </form>
            @endif
            @if(request()->is('dashboard/professors'))
                <a href="{{ route('profile_add_professor') }}" class="btn btn-primary d-inline-flex align-items-right"
                   type="button">
                    Додати викладача
                </a>
            @endif
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Профіль</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data))
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->parent_name }}</td>
                            <td>{{ $item->department->title }}</td>
                            <td><a href="{{ route('profile', ['id' => $item->uid]) }}"
                                   class="badge text-bg-dark rounded-pill">Переглянути профіль</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.dashboard>
