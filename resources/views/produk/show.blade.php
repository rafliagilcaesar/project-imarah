@extends('app')

@section('content')
    <h2>Detail Produk</h2>

    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="row g-0">
            <div class="col-md-4 p-3 text-center">
                @if ($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_produk }}" class="img-fluid rounded" style="max-height: 320px; object-fit: cover;">
                @else
                    <div class="border rounded d-flex align-items-center justify-content-center"
                         style="height: 320px; background: #f8f9fa;">
                        <span class="text-muted">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title mb-1">{{ $produk->nama_produk }}</h4>
                    <div class="text-muted mb-3">Slug: {{ $produk->slug }}</div>

                    <dl class="row mb-0">
                        <dt class="col-sm-4">Harga</dt>
                        <dd class="col-sm-8">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </dd>

                        <dt class="col-sm-4">Kategori</dt>
                        <dd class="col-sm-8">
                            {{ optional($produk->kategoriNama)->nama_kategori ?? '-' }}
                        </dd>

                        <dt class="col-sm-4">Dibuat</dt>
                        <dd class="col-sm-8">{{ $produk->created_at?->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-4">Diperbarui</dt>
                        <dd class="col-sm-8">{{ $produk->updated_at?->format('d M Y H:i') }}</dd>
                    </dl>

                    <hr>

                    <h6 class="mb-2">Deskripsi</h6>
                    <div class="prose">
                        {!! $produk->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
