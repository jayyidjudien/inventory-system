
@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class=" d-flex justify-content-between align-items-center mb-3 p-3">
    <div class="d-flex align-items-start">
        <h3>Daftar Produk</h3>
    </div>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>
</div>
        {{-- Alert Success --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.classList.remove('show');
            }
        }, 3000);
    </script>
@endif

{{-- Alert Error --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<script>

    setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
            // Scroll ke elemen tabel dengan id "inventory-table"
            let table = document.getElementById('inventory-table');
            if (table) {
                table.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                // fallback: scroll ke atas halaman
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }, 3000);

</script>
</div>


<div class="table-responsive shadow-sm rounded">
    <table id="inventory-table" class="table table-striped table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:40px">
                    <input type="checkbox" id="selectAll">
                </th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th class="text-end">Harga</th>
                <th class="text-end">Stok</th>
                <th class="text-end">Nilai Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
                <tr>
                    <td><input type="checkbox" class="row-select" value="{{ $p->id }}"></td>
                    <td class="text-nowrap">{{ $p->kode_product }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->kategori ?? '-' }}</td>
                    <td class="text-end">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($p->stock) }}</td>
                    <td class="text-end">Rp {{ number_format($p->nilai_stock, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="d-inline delete-form" data-name="{{ $p->nama }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($products, 'links'))
    <div class="mt-3">
        {{ $products->links() }}
    </div>
@endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            document.querySelectorAll('.row-select').forEach(cb => cb.checked = this.checked);
        });
    }

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('Hapus produk ini? Tindakan tidak dapat dibatalkan.')) {
                e.preventDefault();
            }
        });
    });
});
</scrip>
@endsection