@extends('layouts.app')

@section('title')
    Properties &mdash; Seller
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Properties</h1>

        <p>
            Want to view sold out properties?
            <a href="{{ route('seller.properties', ['status' => 'sold']) }}">Click here</a>
        </p>

        @if (count($properties) > 0)
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Price (US$)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            <td>
                                <img src="{{ $property->image_url }}" alt="{{ $property->name }}" width="100"
                                    class="rounded-md">
                            </td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->details }}</td>
                            <td>${{ $property->price }}</td>
                            <td>
                                @if ($property->status === 'sold')
                                    <em class="text-green-500">Sold out</em>
                                @else
                                    <em class="text-yellow-500">Not sold</em>
                                @endif
                            </td>

                            <td>
                                <div class="flex items-center gap-x-3.5">
                                    @if ($property->status === 'not_sold')
                                        <form action="{{ route('seller.remove_property', ['id' => $property->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="text-xs font-medium bg-red-500 text-white px-2.5 py-2 rounded-md">
                                                Remove
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('seller.bookings', ['id' => $property->id]) }}">View bookings</a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No properties available.</p>
        @endif
    </div>
@endsection
