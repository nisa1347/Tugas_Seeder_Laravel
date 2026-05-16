@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <h2>Detail Mahasiswa</h2>
    
    <div class="card">
        <div class="card-body">
            <p><strong>NPM:</strong> {{ $mahasiswa->npm }}</p>
            <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
            <p><strong>Dosen Pembimbing:</strong> 
                {{ $mahasiswa->dosen?->nama ?? '-' }} ({{ $mahasiswa->dosen?->nidn ?? '-' }})
            </p>
            
            <h5 class="mt-4">KRS / Mata Kuliah:</h5>
            @if($mahasiswa->krs->isNotEmpty())
                <ul>
                    @foreach($mahasiswa->krs as $krs)
                        <li>
                            {{ $krs->mataKuliah?->nama_matakuliah ?? 'Tidak ada' }} 
                            (SKS: {{ $krs->mataKuliah?->sks ?? 0 }})
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Belum ada mata kuliah yang diambil.</p>
            @endif
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('mahasiswa.edit', $mahasiswa->npm) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('mahasiswa.destroy', $mahasiswa->npm) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
        </form>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection