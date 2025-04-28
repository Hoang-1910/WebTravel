@component('mail::message')
# Xin chào {{ $user->name }}!

Chúc mừng bạn đã đăng ký tài khoản thành công trên **{{ config('app.name') }}**.

Chúng tôi rất vui được đồng hành cùng bạn! 🎉

@component('mail::button', ['url' => route('login')])
Đăng nhập ngay
@endcomponent

Nếu bạn không thực hiện hành động này, vui lòng bỏ qua email này.

Cảm ơn bạn,<br>
{{ config('app.name') }}
@endcomponent
