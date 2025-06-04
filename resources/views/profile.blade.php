@extends('layouts.app')

@section('content')
    <div style="max-width:500px;margin:50px auto;">
        <h1 style="font-size:1.3rem;">پروفایل کاربر</h1>
        <div style="margin-top:20px;">
            <strong>نام:</strong> {{ auth()->user()->name }}<br>
            <strong>ایمیل:</strong> {{ auth()->user()->email }}
        </div>
    </div>
@endsection
