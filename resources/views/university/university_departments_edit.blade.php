<x-layouts.university>
    <div class="tab-pane fade show active" id="departments" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Кафедри</h5>
                <div class="text-end">
                    <button id="openModalDepartmentButton" type="button" class="btn btn-primary btn-sm">Додати кафедру
                    </button>
                </div>

                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Назва</th>
                            <th scope="col">Інститут</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $institute)
                            @foreach($institute->departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->title }}</td>
                                    <td>{{ $institute->full_title }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-circle btn-circle-lg m-1 open-modal"
                                                data-id="{{ $department->id }}"><i
                                                class="fa fa-cog"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div id="add_departments" class="modal">
        <div class="modal-content">
            <span class="close">Х</span>
            <form name="university_add_department" method="POST">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control" name="title" required/>
                    <label class="form-label">Назва</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <select class="form-control" name="institute_id"
                            id="institute_id" required>
                        <option>Оберіть інститут</option>
                        @foreach($institutes as $institute)
                            <option value="{{$institute->id}}">{{$institute->full_title}}</option>
                        @endforeach
                    </select>
                    <label>Інститут/Факультет</label>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Додати інститут
                </button>
                <input type="hidden" name="university_id" value="{{ $globalSetting['id'] }}">
            </form>
        </div>
    </div>
    <div id="edit_departments" class="modal">
        <div class="modal-content">
            <span class="close">Х</span>
            <form name="university_edit_departments" method="POST" action="/department-edit/">
                @csrf

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" class="form-control" name="edit_title"/>
                    <label class="form-label">Назва</label>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Редагувати департамент</button>
                <input type="hidden" name="university_id" value="{{ $globalSetting['id'] }}">
            </form>
        </div>
    </div>

</x-layouts.university>
