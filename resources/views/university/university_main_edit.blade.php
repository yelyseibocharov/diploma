<x-layouts.university>
    <div class="tab-pane fade show active" id="account" role="tabpanel">

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Глобальна інформація</h5>
            </div>
            <div class="card-body">
                <form name="university_main_information" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inputUsername">Назва університету</label>
                                <textarea rows="2" class="form-control" name="full_title"
                                          id="full_title"
                                          placeholder="{{ $globalSetting->full_title }}">{{ $globalSetting->full_title }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputUsername">Абрівеатура</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{ $globalSetting->title }}"
                                       placeholder="{{ $globalSetting->title }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <img alt="Andrew Jones"
                                     src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                     class="rounded-circle img-responsive mt-2" width="128"
                                     height="128">
                                <div class="mt-2">
                                    <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="university_main_information_button" type="submit" class="btn btn-primary" disabled>
                        Редагувати інформацію
                    </button>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Додаткова інформація</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form name="university_additional_information" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputEmail4">Адреса</label>
                            <input type="text" class="form-control" id="address"
                                   name="address"
                                   value="{{ $globalSetting->address }}"
                                   placeholder="{{ $globalSetting->address }}">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="{{ $globalSetting->phone }}"
                                   placeholder="{{ $globalSetting->phone }}">
                        </div>
                        <button id="university_additional_information_button" type="submit" class="btn btn-primary"
                                disabled>Редагувати інформацію
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layouts.university>
