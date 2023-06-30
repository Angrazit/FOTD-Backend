@extends('admin.layout')

@section('style')
    <style>
    .image-container {
            width: 250px;
            height: 400px;
            overflow: hidden;
        }
    .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    .card {
            border: none;
            text-align: center;
        }
    .card-body {
             border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
<div class="row">
    @foreach ($styles as $style)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ Storage::url($style->gambar_path) }}" alt="Another Image">
                  </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
