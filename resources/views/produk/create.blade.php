@extends('app')

@section('content')

    <h2>Tambah Produk</h2>

    <a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Produk</a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Nama Produk --}}
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
               id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}">
        @error('nama_produk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Slug --}}
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror"
               id="slug" name="slug" value="{{ old('slug') }}">
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Harga --}}
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control @error('harga') is-invalid @enderror"
               id="harga" name="harga" value="{{ old('harga') }}">
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Kategori --}}
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select class="form-select @error('kategori') is-invalid @enderror"
                id="kategori_id" name="kategori">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Gambar --}}
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
               id="gambar" name="gambar">
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection

@section('scripts')
    <script>
        console.log('Scripts loaded');

        $(function () {
            $('#deskripsi').summernote({ height: 200, placeholder: 'Tulis deskripsi di sini…' });
        });
    </script>
@endsection
