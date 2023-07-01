@extends('admin.layout')

@section('style')
    <style>
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
<form action="{{ route('create.component', ['id' => $style->id]) }}" method="get" enctype="multipart/form-data" id="myForm">
    {{-- @csrf --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="image-container">
                    <img src="{{ Storage::url($style->gambar_path) }}" alt="gambar">
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="col-sm-8">
                        <div class="p-3 bg-body rounded shadow-sm">
                            <h5 class="text-center">Berapa Component di Style</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="count" id="count">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" name="submit">Isi Component</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



@endsection
