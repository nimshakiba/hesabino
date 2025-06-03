@extends('layouts.admin')

@section('content')
    <div class="admin-header">جزئیات کاربر</div>
    <div style="background:#fff;padding:24px;border-radius:12px;">
        <div><strong>نام:</strong> {{ $user->name }}</div>
        <div><strong>ایمیل:</strong> {{ $user->email }}</div>
        <div><strong>نقش:</strong>
            @if($user->is_admin)
                <span style="color:green;font-weight:bold;">مدیر کل</span>
            @else
                کاربر عادی
            @endif
        </div>
        <!-- اطلاعات کسب‌وکار و دیتابیس‌های کاربر بعداً اضافه می‌شود -->
        <div style="margin-top:2rem;">
            <a href="{{ route('admin.users.index') }}" style="color:#0d99ff;">بازگشت به لیست کاربران</a>
        </div>
    </div>
@endsection
