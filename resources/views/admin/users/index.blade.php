@extends('layouts.admin')

@section('content')
    <div class="admin-header">لیست کاربران</div>
    <table style="width:100%; background:#fff; border-radius:12px; overflow:hidden;">
        <thead style="background:#f0f0f0;">
            <tr>
                <th style="padding:8px;">شناسه</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>نقش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="padding:8px;">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span style="color:green;font-weight:bold;">مدیر کل</span>
                        @else
                            کاربر عادی
                        @endif
                    </td>
                    <td>
                        @if($user->active)
                            <span style="color:green;font-weight:bold;">فعال</span>
                        @else
                            <span style="color:#b71c1c;font-weight:bold;">غیرفعال</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" style="color:#0d99ff;">مشاهده</a>
                        @if(!$user->is_admin)
                            <form action="{{ route('admin.users.make-admin', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" style="color:green;background:none;border:none;cursor:pointer;">مدیر کن</button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.remove-admin', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" style="color:#b71c1c;background:none;border:none;cursor:pointer;">حذف مدیر</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
