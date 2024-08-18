@extends('layout.cms')

@section('content')
    <main class="page-content">
        <h6 class="mb-0 text-uppercase">Tambah Berita</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="reporter_id" value="{{ $currentReporterId }}">
                            <div class="mb-3">
                                <label for="surat_masuk_id" class="form-label">Surat</label>
                                <select id="surat_masuk_id" name="surat_masuk_id" class="form-select" required>
                                    <option value="" disabled {{ old('surat_masuk_id') ? '' : 'selected' }}>Pilih
                                        Surat
                                    </option>
                                    @foreach ($suratList as $surat)
                                        <option value="{{ $surat->id }}"
                                            {{ old('surat_masuk_id') == $surat->id ? 'selected' : '' }}>
                                            {{ ucwords(strtolower($surat->jenis)) }} -
                                            {{ ucwords(strtolower($surat->nama_pengirim)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('surat_masuk_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipe_media" class="form-label">Tipe Media</label>
                                <select id="tipe_media" name="tipe_media" class="form-select" required>
                                    <option value="" disabled selected>Pilih Tipe Media</option>
                                    <option value="website">Website</option>
                                    <option value="radio">Radio</option>
                                    <option value="youtube">YouTube</option>
                                    <option value="media">Media</option>
                                </select>
                                @error('tipe_media')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}"
                            required>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea id="isi" name="isi" class="form-control" rows="4" required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="link_youtube" class="form-label">Link YouTube</label>
                        <input type="url" id="link_youtube" name="link_youtube" class="form-control"
                            value="{{ old('link_youtube') }}">
                        @error('link_youtube')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="audio" class="form-label">Audio</label>
                        <input type="file" id="audio" name="audio" class="form-control">
                        @error('audio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="naskah" class="form-label">Naskah</label>
                        <input type="file" id="naskah" name="naskah" class="form-control">
                        @error('naskah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </main>
@endsection
