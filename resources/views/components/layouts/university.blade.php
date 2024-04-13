<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'UNIVERSITY SYSTEM') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<meta name="theme-color" content="#7952b3">


<style>
    body {
        background: #F0F8FF;
    }

    main {
        margin-top: 20px;
    }

    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #e5e9f2;
        border-radius: .2rem;
    }

    .card-header:first-child {
        border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
    }

    .card-header {
        border-bottom-width: 1px;
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        color: inherit;
        background-color: #fff;
        border-bottom: 1px solid #e5e9f2;
    }

    /* Стили для модального окна */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .close {
        color: #aaa;
        float: right; /* Перемещаем кнопку закрытия вправо */
        font-size: 28px;
        font-weight: bold;
    }

</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">(- Назад у систему</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<main>
    <div class="container p-0">
        <div class="row">
            <div class="col-md-5 col-xl-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Налаштування університету</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_main_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Головна інформація
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_institutes_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Інститути/факультети
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_departments_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Кафедри
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_speciality_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Спеціальності
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_groups_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Навчальні групи
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="{{ route('university_disciplines_edit', ['id' => Auth::user()->university_id]) }}"
                           role="tab">
                            Дисципліни
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </div>

    {{--<script>
        const tabLinks = document.querySelectorAll('.list-group-item');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                const targetTabId = link.getAttribute('href');

                const tabContents = document.querySelectorAll('.tab-pane');

                tabContents.forEach(content => {
                    if (content.getAttribute('id') === targetTabId.substring(1)) {
                        content.classList.add('show', 'active');
                        content.classList.remove('fade');
                    } else {
                        content.classList.remove('show', 'active');
                        content.classList.add('fade');
                    }
                });
            });
        });
    </script>--}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var urlPatternUniversityEdit = /^\/university\/edit\/\d+$/;

        if (urlPatternUniversityEdit.test(window.location.pathname)) {
            $(document).ready(function () {
                // Обработчик события изменения значений в текстовых полях и текстовых областях
                $('form[name="university_main_information"] textarea, form[name="university_main_information"] input[type="text"]').on('input', function () {                // Проверяем, есть ли какое-либо значение в текстовых полях и текстовых областях
                    var hasValue = $('textarea, input[type="text"]').filter(function () {
                        return $.trim($(this).val()).length > 0;
                    }).length > 0;

                    // Если есть значение, удаляем атрибут disabled с кнопки
                    if (hasValue) {
                        $('#university_main_information_button').prop('disabled', false);
                    } else {
                        $('#university_main_information_button').prop('disabled', true);
                    }
                });
            });
            $(document).ready(function () {
                // Обработчик события изменения значений в текстовых полях и текстовых областях
                $('form[name="university_additional_information"] input[type="text"]').on('input', function () {                // Проверяем, есть ли какое-либо значение в текстовых полях и текстовых областях
                    var hasValue = $('textarea, input[type="text"]').filter(function () {
                        return $.trim($(this).val()).length > 0;
                    }).length > 0;

                    // Если есть значение, удаляем атрибут disabled с кнопки
                    if (hasValue) {
                        $('#university_additional_information_button').prop('disabled', false);
                    } else {
                        $('#university_additional_information_button').prop('disabled', true);
                    }
                });
            });
        }
    </script>

    <script>
        const urlPatternInstituteEdit = /^\/university\/edit\/\d+\/institutes$/;
        if (urlPatternInstituteEdit.test(window.location.pathname)) {
            var modalInstitutes = document.getElementById("add_institutes");
            var btnInstitutes = document.getElementById("openModalInstitutesButton");
            var spanInstitutes = document.querySelector("#add_institutes .close");

            // Добавляем обработчик события клика на кнопку
            btnInstitutes.onclick = function () {
                modalInstitutes.style.display = "block";
            }

            // Добавляем обработчик события клика на элемент закрытия модального окна
            spanInstitutes.onclick = function () {
                modalInstitutes.style.display = "none";
            }

            // Закрываем модальное окно, если пользователь щелкает за его пределами
            window.onclick = function (event) {
                if (event.target == modalInstitutes) {
                    modalInstitutes.style.display = "none";
                }
            }
        }
    </script>

    <script>
        if (urlPatternInstituteEdit.test(window.location.pathname)) {
            document.addEventListener("DOMContentLoaded", function () {
                var openModalEditInstituteButtons = document.querySelectorAll('.open-modal');

                openModalEditInstituteButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        var instituteId = this.getAttribute('data-id');
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/get-institute/' + instituteId);
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);

                                // Open the edit institute modal
                                var modalEditInstitutes = document.getElementById("edit_institutes");
                                modalEditInstitutes.style.display = "block";

                                // Fill form fields with data from the object
                                document.getElementsByName('edit_full_title')[0].value = data.full_title;
                                document.getElementsByName('edit_title')[0].value = data.title;

                                // Create hidden input for institute ID
                                var hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'institute_id';
                                hiddenInput.value = data.id;
                                document.forms['university_edit_institutes'].appendChild(hiddenInput);
                            } else {
                                console.error(xhr.responseText);
                            }
                        };
                        xhr.send();
                    });
                });

                // Close the edit institute modal when the close button is clicked
                var closeModalButtons = document.querySelectorAll('#edit_institutes .close');

                closeModalButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        var modalEditInstitutes = document.getElementById("edit_institutes");
                        modalEditInstitutes.style.display = "none";

                        // Remove hidden input when the modal is closed
                        var hiddenInput = document.getElementsByName('institute_id')[0];
                        if (hiddenInput) {
                            hiddenInput.parentNode.removeChild(hiddenInput);
                        }
                    });
                });

                // Close the edit institute modal if clicked outside of it
                window.onclick = function (event) {
                    var modalEditInstitutes = document.getElementById("edit_institutes");
                    if (event.target == modalEditInstitutes) {
                        modalEditInstitutes.style.display = "none";

                        // Remove hidden input when the modal is closed
                        var hiddenInput = document.getElementsByName('institute_id')[0];
                        if (hiddenInput) {
                            hiddenInput.parentNode.removeChild(hiddenInput);
                        }
                    }
                };
            });
        }
    </script>


    <script>
        const urlPatternDepartmentsEdit = /^\/university\/edit\/\d+\/departments$/;
        if (urlPatternDepartmentsEdit.test(window.location.pathname)) {
            var modalDepartments = document.getElementById("add_departments");
            var btnDepartments = document.getElementById("openModalDepartmentButton");
            var spanDepartments = document.querySelector("#add_departments .close");

            // Добавляем обработчик события клика на кнопку
            btnDepartments.onclick = function () {
                modalDepartments.style.display = "block";
            }

            // Добавляем обработчик события клика на элемент закрытия модального окна
            spanDepartments.onclick = function () {
                modalDepartments.style.display = "none";
            }

            // Закрываем модальное окно, если пользователь щелкает за его пределами
            window.onclick = function (event) {
                if (event.target == modalDepartments) {
                    modalDepartments.style.display = "none";
                }
            }
        }
    </script>

    <script>
        if (urlPatternDepartmentsEdit.test(window.location.pathname)) {
            document.addEventListener("DOMContentLoaded", function () {
                var openModalEditInstituteButtons = document.querySelectorAll('.open-modal');

                openModalEditInstituteButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        var departmentId = this.getAttribute('data-id');
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/get-department/' + departmentId);
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                var data = JSON.parse(xhr.responseText);

                                // Open the edit institute modal
                                var modalEditInstitutes = document.getElementById("edit_departments");
                                modalEditInstitutes.style.display = "block";

                                // Fill form fields with data from the object
                                document.getElementsByName('edit_title')[0].value = data.title;

                                // Create hidden input for institute ID
                                var hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'id';
                                hiddenInput.value = data.id;

                                document.forms['university_edit_departments'].appendChild(hiddenInput);
                            } else {
                                console.error(xhr.responseText);
                            }
                        };
                        xhr.send();
                    });
                });

                // Close the edit institute modal when the close button is clicked
                var closeModalButtons = document.querySelectorAll('#edit_departments .close');

                closeModalButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        var modalEditDepartments = document.getElementById("edit_departments");
                        modalEditDepartments.style.display = "none";

                        // Remove hidden input when the modal is closed
                        var hiddenInput = modalEditDepartments.querySelector('input[name="id"]');
                        if (hiddenInput) {
                            hiddenInput.parentNode.removeChild(hiddenInput);
                        }
                    });
                });


                // Close the edit institute modal if clicked outside of it
                window.onclick = function (event) {
                    var modalEditInstitutes = document.getElementById("edit_departments");
                    if (event.target == modalEditInstitutes) {
                        modalEditInstitutes.style.display = "none";

                        // Remove hidden input when the modal is closed
                        var hiddenInput = modalEditDepartments.querySelector('input[name="id"]');
                        if (hiddenInput) {
                            hiddenInput.parentNode.removeChild(hiddenInput);
                        }
                    }
                };
            });

            document.addEventListener("DOMContentLoaded", function () {
                // Находим форму по её имени
                var form = document.forms['university_edit_departments'];

                // Добавляем слушатель события отправки формы
                form.addEventListener('submit', function (event) {
                    // Отменяем стандартное поведение формы, чтобы не происходила перезагрузка страницы
                    event.preventDefault();

                    // Получаем значение института из нужного поля формы (допустим, поле с именем 'institute_id')
                    var instituteId = this.elements['id'].value;

                    // Обновляем action формы, добавляя к нему значение instituteId
                    this.action += instituteId;

                    // Отправляем форму
                    this.submit();
                });
            });
        }
    </script>

    <script>
        if (urlPatternInstituteEdit.test(window.location.pathname)) {
            document.addEventListener("DOMContentLoaded", function () {
                // Находим форму по её имени
                var form = document.forms['university_edit_institutes'];

                // Добавляем слушатель события отправки формы
                form.addEventListener('submit', function (event) {
                    // Отменяем стандартное поведение формы, чтобы не происходила перезагрузка страницы
                    event.preventDefault();

                    // Получаем значение института из нужного поля формы (допустим, поле с именем 'institute_id')
                    var instituteId = this.elements['institute_id'].value;

                    // Обновляем action формы, добавляя к нему значение instituteId
                    this.action += instituteId;

                    // Отправляем форму
                    this.submit();
                });
            });
        }
    </script>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
