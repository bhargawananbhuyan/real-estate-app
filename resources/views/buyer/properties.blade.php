@extends('layouts.app')

@section('title')
    Properties &mdash; {{ config('app.name') }}
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Properties</h1>

        @if (count($properties) > 0)
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($properties as $property)
                    <section class="border rounded-md p-2.5 grid gap-y-2.5">
                        <img src="{{ $property->image_url }}" alt="{{ $property->name }}" class="w-full object-cover rounded">
                        <h3 class="font-bold">{{ $property->name }}</h3>
                        <em class="text-gray-500">{{ $property->details }}</em>
                        <strong>${{ $property->price }}</strong>
                        <form action="{{ route('buyer.book_property', ['id' => $property->id]) }}" method="post">
                            @csrf
                            <button type="submit"
                                class="p-2.5 rounded-md bg-teal-500 text-white text-sm font-medium w-full">
                                Book now
                            </button>
                        </form>
                    </section>
                @endforeach
            </div>
        @else
            <p>No properties available.</p>
        @endif
    </div>
@endsection
