@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <h2>Edit Mahasiswa</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>NPM</label>
            <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" 
                   value="{{ old('npm', $mahasiswa->npm) }}" required>
            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $mahasiswa->nama) }}" required>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Dosen Pembimbing (NIDN)</label>
            <select name="nidn" class="form-control @error('nidn') is-invalid @enderror">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->nidn }}" 
                        {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                        {{ $dosen->nama }} ({{ $dosen->nidn }})
                    </option>
                @endforeach
            </select>
            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection