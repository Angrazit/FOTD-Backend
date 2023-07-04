@extends('admin.layout')

@section('style')
    <style>
        .image-containera {
            width: 250px;
            height: 400px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .image-containera img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-container {
            width: 100%;
            height: 800px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .image-container img {
            max-width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    {{-- @csrf --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="image-container">
                    <img src="{{ Storage::url($styles->gambar_path) }}" alt="gambar">
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="col-sm-8">
                        <div class="p-3 bg-body rounded shadow-sm">
                            @foreach ($products as $product)
                                <div class="mb-3 row d-flex align-items-center">
                                            <div class="image-containera">
                                                <a href="{{ $product->link_toko }}">
                                                    <img src="{{ Storage::url($product->link_local) }}" alt="gambar">
                                                </a>
                                            </div>

                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
