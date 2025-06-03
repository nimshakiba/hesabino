@extends('layouts.app')

@section('content')
    <div style="max-width:500px;margin:auto;">
        <h1 style="font-size:1.2rem;font-weight:bold;margin-bottom:1.5rem;">ثبت شخص جدید</h1>
        <form method="POST" action="{{ route('persons.store') }}">
            @csrf
            <div style="margin-bottom:14px;">
                <label for="name">نام <span style="color:red">*</span></label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" style="width:100%;padding:9px 10px;border-radius:8px;border:1px solid #ccc;">
                @error('name') <div style="color:red;">{{ $message }}</div> @enderror
            </div>
            <div style="margin-bottom:14px;">
                <label for="email">ایمیل</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" style="width:100%;padding:9px 10px;border-radius:8px;border:1px solid #ccc;">
                @error('email') <div style="color:red;">{{ $message }}</div> @enderror
            </div>
            <div style="margin-bottom:14px;">
                <label for="mobile">موبایل</label>
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" style="width:100%;padding:9px 10px;border-radius:8px;border:1px solid #ccc;">
                @error('mobile') <div style="color:red;">{{ $message }}</div> @enderror
            </div>
            <button type="submit" style="width:100%;padding:11px 0;border-radius:8px;background:#2196f3;color:#fff;border:none;font-weight:bold;">ثبت شخص</button>
        </form>
        <div style="margin-top:22px;">
            <a href="{{ route('persons.index') }}" style="color:#2196f3;">بازگشت به لیست اشخاص</a>
        </div>
    </div>
@endsection
