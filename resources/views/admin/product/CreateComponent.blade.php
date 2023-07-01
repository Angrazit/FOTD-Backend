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

        .custom-btn-width {
            width: 40%;
        }
    </style>
@endsection

@section('content')
    <form action='{{ route('storetodata.product') }}' method='post' enctype="multipart/form-data">
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="row align-items-center">
                <!-- Add align-items-center class -->
                <div class="col-md-6">
                    <div class="image-container">
                        <img src="{{ Storage::url($style->gambar_path) }}" alt="gambar">
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="style_id" value="{{ $style->id }}">
                    @for ($i = 0; $i < $count; $i++)

                        <div id="form-container" class="mb-2 p-3 bg-body rounded shadow-sm">
                            <div class="form-group">
                                <div class="mb-3 row d-flex align-items-center">
                                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="category" name="inputs[{{ $i }}][category]" placeholder="category">
                                            <option value="">Select a category</option>
                                            <option value="baju">Baju</option>
                                            <option value="celana">Celana</option>
                                            <option value="aksesoris">Aksesoris</option>
                                            <option value="alas kaki">Alas kaki</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row d-flex align-items-center">
                                    <label for="nim" class="col-sm-2 col-form-label">link toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="inputs[{{ $i }}][toko]" placeholder="toko" id="toko">
                                    </div>
                                </div>
                                <div class="mb-3 row d-flex align-items-center">
                                    <label for="nim" class="col-sm-2 col-form-label">deskripsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="deskripsi" name="inputs[{{ $i }}][deskripsi]" placeholder="deskripsi">
                                    </div>
                                </div>
                                <div class="mb-3 row d-flex align-items-center">
                                    <label for="image" class="col-sm-2 col-form-label">Gambar file</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="images[{{ $i }}]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="mb-3 row">
                        <div class="col-sm-14">
                            <button type="submit" class="btn btn-primary custom-btn-width" name="submit">SIMPAN</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
@endsection
