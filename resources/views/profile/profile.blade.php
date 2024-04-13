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
                <form class="file-upload" method="POST" action="/profile/edit/professor/{{$data->uid}}">
                    @csrf
                    <div class="row mb-5 gx-5">
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Загальна інформація</h4>
                                    <div class="col-md-6">
                                        <label class="form-label">Прізвище*</label>
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder="{{ $data->last_name }}" aria-label="Прізвищe"
                                               value="{{ $data->last_name }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ім'я*</label>
                                        <input type="text" class="form-control" name="first_name"
                                               placeholder="{{ $data->first_name }}" aria-label="Ім'я"
                                               value="{{ $data->first_name }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">По-Батькові</label>
                                        <input type="text" class="form-control" name="parent_name"
                                               placeholder="{{ $data->parent_name }}" aria-label="Ім'я"
                                               value="{{ $data->parent_name }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Дата народження</label>
                                        <input type="date" class="form-control"
                                               placeholder="date_of_birthday"
                                               name="date_of_birth"
                                               value="{{ $data->date_of_birth }}"
                                               aria-label="Дата народження" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email *</label>
                                        <input type="email" name="email" class="form-control" name="email"
                                               placeholder="{{ $data->email }}" id="inputEmail4"
                                               value="{{ $data->email }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Номер телефону*</label>
                                        <input type="text" class="form-control" placeholder="+38 (099) 661 07 66"
                                               aria-label="Телефон" value="{{ $data->phone_number }}" name="phone_number">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Посада*</label>
                                        <input type="text" class="form-control" placeholder="{{ $data->function }}"
                                               aria-label="Посада" name="function"
                                               value="{{ $data->function }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Доступ*</label>
                                        <input type="text" class="form-control" placeholder="{{ $data->permission }}" name="permission"
                                               value="{{ $data->permission }}" {{ empty($permission) ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Назва ВНЗ*</label>
                                        <input type="text" class="form-control" placeholder="{{ $university_name }}"
                                               aria-label="Назва ВНЗ"
                                               value="{{ $university_name }}" readonly disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Інститут/Факультет</label>
                                        <select class="form-control" name="institute_id"
                                                id="institute_id" {{ empty($permission) ? 'disabled' : '' }}>
                                            <option value="{{ $data->department->id }}">{{ $data->department }}</option>
                                            @foreach ($institutes as $institute)
                                                <option
                                                    value="{{ $institute->id }}">{{ $institute->full_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Кафедра/Відділення</label>
                                        <select class="form-control" name="department_id" id="department_id" disabled>
                                            <option
                                                value="{{ $data->department->id }}">{{ $data->department->title }}</option>
                                        </select>

                                        <script>
                                            document.getElementById('institute_id').addEventListener('change', function () {
                                                var departmentSelect = document.getElementById('department_id');
                                                departmentSelect.innerHTML = '<option value="{{ $data->department->id }}">{{ $data->department->title }}</option>';
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
                                    <div class="text-center">
                                        <div class="square position-relative display-2 mb-3">
                                            <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                        </div>
                                        <input type="file" id="customFile" name="file" hidden="">
                                        {{--<label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                        <button type="button" class="btn btn-danger-soft">Remove</button>--}}
                                        <p class="text-muted mt-3 mb-0"></p>
                                    </div>
                                    <div class="gap-3 justify-content-md-end text-center">
                                        @if(!empty($permission))
                                            @if($data->status_code === 0)
                                                <button class="btn btn-success rounded-pill px-3" type="button">Активувати</button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-lg">Архівувати</button>

                                                <button type="submit" class="btn btn-primary btn-lg">Оновити</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">

                                <div class="row g-3">
                                    @foreach($documents as $item)
                                        @if($item->type === 'passport')
                                            <h4 class="mb-4 mt-0">Паспортні дані</h4>
                                            <!-- First Name -->
                                            <div class="col-md-6">
                                                <label class="form-label">Серія</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ $item->series ? 'NULL' : $item->series }}"
                                                       value="{{ $item->series ? 'NULL' : $item->series }}"
                                                       name="passport_series"
                                                    {{ empty($permission) ? 'readonly disabled' : '' }}
                                                >
                                            </div>
                                            <!-- Last name -->
                                            <div class="col-md-6">
                                                <label class="form-label">Номер</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ $item->number }}"
                                                       value="{{ $item->number }}"
                                                       name="passport_number"
                                                    {{ empty($permission) ? 'readonly disabled' : '' }}
                                                >
                                            </div>
                                            <!-- Phone number -->
                                            <div class="col-md-6">
                                                <label class="form-label">Виданий</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ $item->created }}"
                                                       value="{{ $item->created }}"
                                                       name="passport_created"
                                                    {{ empty($permission) ? 'readonly disabled' : '' }}
                                                >
                                            </div>
                                        @endif

                                        @if($item->type === 'tax_card')
                                            <div class=" col-md-6">
                                                <label class="form-label">РНОКПП</label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{ $item->number }}"
                                                       value="{{ $item->number }}"
                                                       name="tax_number"
                                                    {{ empty($permission) ? 'readonly disabled' : '' }}
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Облікові налаштування</h4>
                                    @if($data->uid === auth()->user()->uid)
                                        <div class="col-md-6">
                                            <label class="form-label">Старий пароль</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Новий пароль</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Повторіть пароль</label>
                                            <input type="password" class="form-control">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <button class="btn btn-primary rounded-pill px-3" type="button">Скинути пароль
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
