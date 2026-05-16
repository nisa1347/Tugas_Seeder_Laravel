<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-4">
        
        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Header + Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center mb-0">Daftar Mahasiswa</h1>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        {{-- 🔍 FORM PENCARIAN --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('mahasiswa.index') }}" method="GET" class="row g-2">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari berdasarkan NPM, Nama, atau Dosen..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">🔍 Cari</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary w-100">🔄 Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info Hasil Pencarian --}}
        @if(request('search'))
            <p class="text-muted mb-3">
                Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong> 
                ({{ $mahasiswa->total() }} data ditemukan)
            </p>
        @endif

        {{-- Tabel Data --}}
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Dosen Wali</th>
                    <th>Mata Kuliah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
                        <td>{{ $mhs->npm }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}">{{ $mhs->nama }}</a>
                        </td>
                        <td>{{ $mhs->dosen?->nama ?? 'N/A' }}</td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach ($mhs->krs as $krs)
                                    <li>{{ $krs->mataKuliah?->nama_matakuliah ?? 'Tidak ada' }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            {{ request('search') ? 'Tidak ada hasil untuk "' . request('search') . '"' : 'Belum ada data mahasiswa' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- 📄 PAGINATION LINKS --}}
        <div class="d-flex justify-content-center">
            {{ $mahasiswa->links() }}
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>