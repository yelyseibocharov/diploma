<x-layouts.dashboard>
    <style>
        body {
            color: #9b9ca1;
        }

        .bg-secondary-soft {
            background-color: rgba(208, 212, 217, 0.1) !important;
        }

        .rounded {
            border-radius: 5px !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .file-upload .square {
            height: 250px;
            width: 250px;
            margin: auto;
            vertical-align: middle;
            border: 1px solid #e5dfe4;
            background-color: #fff;
            border-radius: 5px;
        }

        .text-secondary {
            --bs-text-opacity: 1;
            color: rgba(208, 212, 217, 0.5) !important;
        }

        .btn-success-soft {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }

        .btn-danger-soft {
            color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.6;
            color: #29292e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e5dfe4;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 5px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
          integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous"/>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="file-upload" method="POST">
                    @csrf
                    <div class="row mb-5 gx-5">
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Загальна інформація</h4>
                                    <div class="col-md-6">
                                        <label class="form-label">Прізвище*</label>
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder="Шевченко" aria-label="Прізвищe"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ім'я*</label>
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="Тарас" aria-label="Ім'я"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">По-Батькові</label>
                                        <input type="text" class="form-control" name="parent_name"
                                               placeholder="Григорович" aria-label="Ім'я"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Дата народження</label>
                                        <input type="date" class="form-control" placeholder="date_of_birthday"
                                               aria-label="Дата народження"
                                               name="date_of_birth"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email *</label>
                                        <input type="email" name="email" class="form-control"
                                               placeholder="example@example.com" id="inputEmail4"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Номер телефону</label>
                                        <input type="text" class="form-control" placeholder="+38 (099) 661 07 66"
                                               aria-label="Телефон" value="+38 (099) 661 07 66"
                                               name="phone_number"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Посада*</label>
                                        <input type="text" name="function" class="form-control" placeholder="Доцент"
                                               aria-label="Посада"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Доступ*</label>
                                        <input name="permission" type="text" class="form-control" placeholder="0"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Інститут/Факультет</label>
                                        <select class="form-control" name="institute_id"
                                                id="institute_id">
                                            <option value=""></option>
                                            @foreach ($institutes as $institute)
                                                <option
                                                    value="{{ $institute->id }}">{{ $institute->full_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Кафедра/Відділення</label>
                                        <select class="form-control" name="department_id" id="department_id" disabled>
                                            <option value=""></option>
                                        </select>

                                        <script>
                                            document.getElementById('institute_id').addEventListener('change', function () {
                                                var departmentSelect = document.getElementById('department_id');
                                                departmentSelect.innerHTML = '<option value=""></option>';
                                                departmentSelect.disabled = true;

                                                var instituteId = this.value;

                                                if (instituteId) {
                                                    fetch('/get-departments/' + instituteId)
                                                        .then(response => response.json())
                                                        .then(departments => {
                                                            departments.forEach(department => {
                                                                var option = document.createElement('option');
                                                                option.value = department.id;
                                                                option.textContent = department.title;
                                                                departmentSelect.appendChild(option);
                                                            });

                                                            departmentSelect.disabled = false;
                                                        })
                                                        .catch(error => console.error('Ошибка получения департаментов:', error));
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <div class="gap-3 justify-content-md-end text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Додати викладача</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">

                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Паспортні дані</h4>
                                    <div class="col-md-6">
                                        <label class="form-label">Серія*</label>
                                        <input type="text" class="form-control"
                                               name="passport_series"
                                               placeholder="AA"
                                               value="NULL"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Номер*</label>
                                        <input type="text" class="form-control"
                                               placeholder="111111"
                                               name="passport_number"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Виданий*</label>
                                        <input type="text" class="form-control"
                                               placeholder="1010"
                                               name="passport_created"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Дата видачі*</label>
                                        <input type="date" class="form-control"
                                               placeholder="1010"
                                               name="passport_created_from"
                                               required
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Дійсний до*</label>
                                        <input type="date" class="form-control"
                                               placeholder="1010"
                                               name="passport_created_until"
                                               required
                                        >
                                    </div>
                                    <div class=" col-md-6">
                                        <label class="form-label">РНОКПП</label>
                                        <input type="text" class="form-control"
                                               placeholder="1111111111"
                                               name="tax_card"
                                               required
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="init_user" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="university_id" value="{{ auth()->user()->university_id}}">

                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
