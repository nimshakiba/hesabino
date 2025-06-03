@extends('layouts.app')

@section('content')
    <div style="max-width:900px;margin:auto;">
        <h1 style="font-size:1.4rem;font-weight:bold;margin-bottom:1.5rem;">لیست اشخاص ثبت‌نامی</h1>
        @if(session('success'))
            <div style="background:#e7ffea;color:#15910a;border-radius:10px;padding: 0.5rem 1rem;">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" style="margin-bottom:16px;display:flex;gap:10px;">
            <input type="text" name="search" placeholder="جستجو بر اساس نام یا ایمیل..." value="{{ request('search') }}" style="flex:1;padding:7px 12px;border-radius:8px;border:1px solid #ccc;">
            <button type="submit" style="padding:7px 18px;border-radius:8px;background:#2196f3;color:#fff;border:none;">جستجو</button>
            <a href="{{ route('persons.create') }}" style="padding:7px 18px;border-radius:8px;background:#ffd600;color:#222;text-decoration:none;">افزودن شخص جدید</a>
        </form>
        <table style="width:100%;background:#fff;border-radius:12px;overflow:hidden;">
            <thead style="background:#f7f7f7;">
                <tr>
                    <th style="padding:8px;">شناسه</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>موبایل</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persons as $person)
                    <tr>
                        <td style="padding:8px;">{{ $person->id }}</td>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->email ?? '-' }}</td>
                        <td>{{ $person->mobile ?? '-' }}</td>
                        <td>
                            @if($person->active)
                                <span style="color:green;font-weight:bold;">فعال</span>
                            @else
                                <span style="color:#b71c1c;font-weight:bold;">غیرفعال</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('persons.toggle-active', $person) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" style="color:#fff;border:none;border-radius:8px;padding:6px 13px;cursor:pointer;background:{{ $person->active ? '#b71c1c' : '#43a047' }};">
                                    {{ $person->active ? 'غیرفعال کن' : 'فعال کن' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top:20px;">
            {{ $persons->links() }}
        </div>
    </div>
@endsection
