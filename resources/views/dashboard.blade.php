@extends(auth()->user()->is_admin ? 'layouts.admin' : 'layouts.app')

@section('content')
    <h1 style="font-size:1.3rem;font-weight:bold;">خوش آمدید {{ auth()->user()->name }}</h1>
    @if(auth()->user()->is_admin)
        <p>این بخش مخصوص مدیرکل است.</p>
    @else
        <p>این بخش مخصوص کاربران عادی است.</p>
    @endif
@endsection
