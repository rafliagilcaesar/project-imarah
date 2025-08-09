@extends('app')

@section('content')

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped table-hover table-bordered">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($produks as $produk)
       <tr>
           <td>{{ $loop->iteration }}</td>
           <td>{{ $produk->nama_produk }}</td>
           <td>{{ $produk->harga }}</td>
           <td>{{ $produk->kategori }}</td>
           <td>
               <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
               <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-info">Lihat</a>
               <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
               </form>
           </td>
       </tr>
       @endforeach
    </tbody>
</table>

@endsection
