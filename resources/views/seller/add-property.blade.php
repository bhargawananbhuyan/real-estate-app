@extends('layouts.app')

@section('title')
    Add property &mdash; Seller
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Add a new property</h1>

        <form action="{{ route('seller.add_property') }}" method="post" enctype="multipart/form-data" class="base-form"
            novalidate>
            @csrf
            <div>
                <div class="max-w-[200px]">
                    <img src="#" alt="" id="uploaded_img" style="display: none;" class="w-full rounded-md">
                </div>

                <label for="property_img">Property image</label>
                <input type="file" name="property_img" id="property_img" accept="image/*"
                    value="{{ old('property_img') }}">
                @error('property_img')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="details">Details</label>
                <textarea name="details" id="details" rows="5">{{ old('details') }}</textarea>
                @error('details')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}">
                @error('price')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <button type="submit">Add property</button>
        </form>
    </div>

    @push('body_scripts')
        <script>
            document.querySelector('#property_img').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const image = document.querySelector('#uploaded_img');
                        image.src = e.target.result;
                        image.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection
