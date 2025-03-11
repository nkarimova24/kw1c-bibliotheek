@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welkom op je dashboard, {{ Auth::user()->first_name }}!</h1>
    <p>Hier kun je je geleende boeken en laptops bekijken.</p>
</div>
@endsection
