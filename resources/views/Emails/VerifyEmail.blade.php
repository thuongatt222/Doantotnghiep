<h3>Hi {{$account->name}}</h3>
<div>
    <p>Noi dung</p>
</div>
<div>
    <a href="{{route('account.verify', $account->email)}}">Click to verify account</a>
</div>