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

        {{-- Tabel Data --}}
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Dosen Wali</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        {{-- ✅ NPM (bukan NIM) --}}
                        <td>{{ $mhs->npm }}</td>
                        
                        {{-- ✅ Link kirim $mhs->npm sebagai parameter --}}
                        <td>
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}">{{ $mhs->nama }}</a>
                        </td>
                        
                        {{-- ✅ Dosen via relasi nidn --}}
                        <td>{{ $mhs->dosen?->nama ?? 'N/A' }}</td>
                        
                        {{-- ✅ List Mata Kuliah via KRS --}}
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach ($mhs->krs as $krs)
                                    <li>{{ $krs->mataKuliah?->nama_matakuliah ?? 'Tidak ada' }}</li>
                                @endforeach
                            </ul>
                        </td>
                        
                        {{-- ✅ Tombol Aksi kirim $mhs->npm --}}
                        <td class="text-center">
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data mahasiswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>