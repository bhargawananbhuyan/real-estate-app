@extends('layouts.app')

@section('title')
    Home &mdash; {{ config('app.name') }}
@endsection

@section('main')
    <div class="grid place-items-center text-center">
        <span class="text-6xl">🏘️</span>
        <h1 class="text-2xl font-bold mt-5 mb-1">Hi {{ Auth::user()->name ?? 'there' }}!</h1>
        <p>Welcome to {{ config('app.name') }}</p>
    </div>
@endsection
