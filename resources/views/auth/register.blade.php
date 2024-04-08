<x-layouts.app>
    <form method="POST">
        @csrf
        <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Register</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="first_name" id="floatingInput" placeholder="First name">
            <label for="floatingInput">First name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="last_name" id="floatingInput" placeholder="Last Name">
            <label for="floatingInput">Last name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="parent_name" id="floatingInput" placeholder="Parent Name">
            <label for="floatingInput">Parent name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        @if(session('error'))
            <div>
                {{session('error')}}
            </div>
        @endif
        <p class="mt-5 mb-3 text-muted">Yelysei Bocharov 2024</p>
    </form>
</x-layouts.app>
