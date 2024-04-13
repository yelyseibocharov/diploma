<x-layouts.university>
    <div class="tab-pane fade show active" id="institutes" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Інститути</h5>
                <div class="text-end">
                    <button id="openModalInstitutesButton" type="button" class="btn btn-primary btn-sm">Додати
                        інститут
                    </button>
                </div>

                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Повна назва</th>
                            <th scope="col">Абрівеатура</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_title }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <button class="btn btn-primary btn-circle btn-circle-lg m-1 open-modal"
                                            data-id="{{ $item->id }}"><i class="fa fa-cog"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div id="add_institutes" class="modal">
        <div class="modal-content">
            <span class="close">Х</span>
            <form name="university_add_institutes" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="full_title"/>
                            <label class="form-label">Повна назва</label>
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="title"/>
                            <label class="form-label">Абрівеатура</label>
                        </div>
                    </div>
                </div>

                {{--<div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control"/>
                    <label class="form-label">Інститут/Факультет</label>
                </div>--}}

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Додати інститут
                </button>
                <input type="hidden" name="university_id" value="{{ $globalSetting['id'] }}">
            </form>
        </div>
    </div>

    <div id="edit_institutes" class="modal">
        <div class="modal-content">
            <span class="close">Х</span>
            <form name="university_edit_institutes" method="POST" action="/institute-edit/">
                @csrf
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="edit_full_title"/>
                            <label class="form-label">Повна назва</label>
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" class="form-control" name="edit_title"/>
                            <label class="form-label">Абрівеатура</label>
                        </div>
                    </div>
                </div>

                {{--<div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control"/>
                    <label class="form-label">Інститут/Факультет</label>
                </div>--}}

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Редагувати інститут</button>
                <input type="hidden" name="university_id" value="{{ $globalSetting['id'] }}">
            </form>
        </div>
    </div>

</x-layouts.university>
