<x-layouts.university>
    <div class="tab-pane fade show active" id="departments" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Спеціальності</h5>
                <div class="text-end">
                    <button id="openModalDepartmentButton" type="button" class="btn btn-primary btn-sm">Додати спеціальність
                    </button>
                </div>

                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Шифр</th>
                            <th scope="col">Назва</th>
                            <th scope="col">Інститут</th>
                            <th scope="col">Кафедра</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>122</td>
                                    <td>Комп'ютерні науки та інтелектуальні системи</td>
                                    <td>Комп'ютерних наук</td>
                                    <td>ПІІТУ</td>
                                    <td>
                                        <button class="btn btn-primary btn-circle btn-circle-lg m-1"><i
                                                    class="fa fa-cog"></i></button>
                                    </td>
                                </tr>

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

                            <option value=""></option>


                    </select>
                    <label>Інститут/Факультет</label>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Додати інститут
                </button>
                <input type="hidden" name="university_id" value="">
            </form>
        </div>
    </div>
</x-layouts.university>
