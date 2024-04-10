<h3>Hi: {{$account->name}}</h3>
<div>
    <p>Noi dung</p>
</div>
<div>
    <a href="{{route('account.reset_password', $account->email)}}">Xác nhận thay đổi mật khẩu</a>
</div>