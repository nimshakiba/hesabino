@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ثبت کسب‌وکار جدید</h1>
    <form method="POST" action="{{ route('business.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">نام کسب‌وکار</label>
            <input type="text" class="form-control" id="name" name="name" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ثبت کسب‌وکار</button>
    </form>
</div>
@endsection
