<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Đăng nhập | Đăng ký</title>
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up">
        <form method="POST" action="{{route('account.register')}}">
            @csrf
            <h1>Tạo tài khoản</h1>
            <div class="social-icons">
                <a href="{{ route('auth.google') }}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            </div>
            <span>hoặc sử dụng email của bạn</span>
            <input type="text" placeholder="Name" name="name">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Confirm password" name="confirm-password">
            <button type="submit">Đăng ký</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form method="POST" action="{{route('account.login')}}">
            <h1>Đăng nhập</h1>
            <div class="social-icons">
                <a href="{{ route('auth.google') }}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            </div>
            <span>hoặc sử dụng email của bạn</span>
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <button type="button" class="btn btn-link" style="background-color: #fff; color: #333"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Quên mật khẩu?
            </button>
            <button>Đăng nhập</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Chào mừng trở lại</h1>
                <p>Đăng nhập vào trang web để sử dụng tất cả tính năng</p>
                <button class="hidden" id="login">Đăng nhập</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Xin chào</h1>
                <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                <button class="hidden" id="register">Đăng ký</button>
            </div>
        </div>
    </div>
</div>

{{--Modal--}}

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Quên mật khẩu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Xin vui lòng nhập email của bạn</p>
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="Email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
{{--End modal--}}

<script src="../../js/login.js"></script>

</body>
</html>
