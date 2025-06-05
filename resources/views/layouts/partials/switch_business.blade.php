<form method="POST" action="{{ route('switch-business') }}">
    @csrf
    <select name="business_id" onchange="this.form.submit()">
        @foreach(auth()->user()->businesses as $biz)
            <option value="{{ $biz->id }}" @selected(session('current_business_id') == $biz->id)>
                {{ $biz->name }}
            </option>
        @endforeach
    </select>
</form>
