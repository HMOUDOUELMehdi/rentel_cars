<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/registerStyle.css') }}">
</head>
<body  style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
<form action="{{ route('register.submit') }}" method="post" class="form" autocomplete="off" >
    @csrf
    <div class="control">
        <h1>Register</h1>
    </div>
    <div class="control block-cube block-input">
        <input name="name" type="text" placeholder="Name">
        <div class="bg-top">
            <div class="bg-inner"></div>
        </div>
        <div class="bg-right">
            <div class="bg-inner"></div>
        </div>
        <div class="bg">
            <div class="bg-inner"></div>
        </div>
    </div>
    <div class="control block-cube block-input">
        <input name="email" type="email" placeholder="Email">
        <div class="bg-top">
            <div class="bg-inner"></div>
        </div>
        <div class="bg-right">
            <div class="bg-inner"></div>
        </div>
        <div class="bg">
            <div class="bg-inner"></div>
        </div>
    </div>
    <div class="control block-cube block-input">
        <input name="tel" type="number" placeholder="Telephone">
        <div class="bg-top">
            <div class="bg-inner"></div>
        </div>
        <div class="bg-right">
            <div class="bg-inner"></div>
        </div>
        <div class="bg">
            <div class="bg-inner"></div>
        </div>
    </div>
    <div class="control block-cube block-input">
        <input name="password" type="password" placeholder="Password">
        <div class="bg-top">
            <div class="bg-inner"></div>
        </div>
        <div class="bg-right">
            <div class="bg-inner"></div>
        </div>
        <div class="bg">
            <div class="bg-inner"></div>
        </div>
    </div>
    <button class="btn block-cube block-cube-hover" type="submit">
        <div class="bg-top">
            <div class="bg-inner"></div>
        </div>
        <div class="bg-right">
            <div class="bg-inner"></div>
        </div>
        <div class="bg">
            <div class="bg-inner"></div>
        </div>
        <div class="text">Register</div>
    </button>
</form>
{{--<a href="{{ route("login") }}">Already have an account? Login</a>--}}
</body>
</html>
