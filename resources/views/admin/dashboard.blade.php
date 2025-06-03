@extends('layouts.admin')

@section('content')
    <div class="admin-header">داشبورد مدیریت</div>
    <div style="display: flex; gap: 2rem;">
        <div>
            <div>تعداد کل کاربران:</div>
            <div style="font-size:1.5rem;font-weight:bold">{{ $users_count }}</div>
        </div>
        <div>
            <div>تعداد مدیران کل:</div>
            <div style="font-size:1.5rem;font-weight:bold">{{ $admins_count }}</div>
        </div>
    </div>
@endsection
