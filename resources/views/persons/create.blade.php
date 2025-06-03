@extends('layouts.app')

@section('content')
    <div style="max-width:500px;margin:auto;">
        <h1 style="font-size:1.2rem;font-weight:bold;margin-bottom:1.5rem;">ثبت شخص جدید</h1>
        <form method="POST" action="{{ route('persons.store') }}">
            @csrf

            <div style="margin-bottom:15px;">
                <label for="person_category_id">دسته‌بندی شخص <span style="color:red">*</span></label>
                <select name="person_category_id" id="person_category_id" required style="width:100%;padding:9px 10px;border-radius:8px;border:1px solid #ccc;">
                    <option value="">انتخاب دسته‌بندی...</option>
                </select>
                @error('person_category_id') <div style="color:red;">{{ $message }}</div> @enderror
            </div>

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

@section('scripts')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#person_category_id').select2({
                placeholder: 'انتخاب دسته‌بندی...',
                dir: 'rtl',
                ajax: {
                    url: '{{ route('ajax.person_categories') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return { results: data.results };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
