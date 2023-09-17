@extends('html.html')

@section('content')
    <form action="{{ route('loginProcess') }}" method="post">
        @csrf
        <input type="text" name="email">
        <input type="text" name="password">
        <button type="submit">login</button>
    </form>
@endsection
