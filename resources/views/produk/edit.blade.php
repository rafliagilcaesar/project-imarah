@extends('app')

@section('content')
    <h2>Edit Produk</h2>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Produk</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk"
                   class="form-control @error('nama_produk') is-invalid @enderror"
                   value="{{ old('nama_produk', $produk->nama_produk) }}">
            @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Slug --}}
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug"
                   class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $produk->slug) }}">
            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" id="harga" name="harga"
                   class="form-control @error('harga') is-invalid @enderror"
                   value="{{ old('harga', $produk->harga) }}">
            @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select id="kategori" name="kategori"
                    class="form-select @error('kategori') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori', $produk->kategori) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" id="gambar" name="gambar"
                   class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
            @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror

            @if ($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}"
                     alt="{{ $produk->nama_produk }}" class="mt-2" style="max-height:200px;">
            @endif
        </div>

        {{-- Deskripsi (pakai Summernote) --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"
                      class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{!!
                old('deskripsi', $produk->deskripsi)
            !!}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection

@section('scripts')
    {{-- pastikan jQuery & Summernote sudah dimuat di layout, lalu inisialisasi di sini --}}
    <script>
        $(function () {
            $('#deskripsi').summernote({ height: 200, placeholder: 'Tulis deskripsi di sini…' });
        });
    </script>
@endsection
