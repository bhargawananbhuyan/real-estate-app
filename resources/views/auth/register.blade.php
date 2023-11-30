@extends('layouts.app')

@section('title')
    Register &mdash; {{ config('app.name') }}
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Register</h1>

        <form action="{{ route('register') }}" method="post" class="base-form">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="role">Register as</label>
                <select name="role" id="role">
                    <option>-- Select a user role --</option>
                    <option value="buyer" @selected(old('role') === 'buyer')>Buyer</option>
                    <option value="seller" @selected(old('role') === 'seller')>Seller</option>
                    <option value="admin" @selected(old('role') === 'admin')>Administrator</option>
                </select>
                @error('role')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <button type="submit">Register</button>
        </form>

        <p>
            Already registered? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
@endsection
