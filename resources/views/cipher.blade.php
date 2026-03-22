@extends('layouts/new')

@section('content')

<div class="container mt-5 pt-5 mb-5">
    <h2 class="fw-bold mb-4 text-dark">Cipher</h2>
    <div class="row">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Konfigurasi Sandi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/cipher/process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Teks Asli</label>
                            <textarea name="text" class="form-control" rows="3" required>{{ $text ?? '' }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Aksi</label>
                                    <select name="action" class="form-control">
                                        <option value="encode">Enkripsi (Encode)</option>
                                        <option value="decode">Dekripsi (Decode)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Shift (Lompatan)</label>
                                    <input type="number" name="shift" class="form-control" value="{{ $shift ?? 13 }}" min="1" max="25">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-secondary btn-block">Proses Data</button>
                    </form>
                </div>
            </div>
        </div>

        @if(isset($result))
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Hasil Pemrosesan (Shift: {{ $shift }})</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea id="hasilTeks" class="form-control" rows="3" readonly>{{ $result }}</textarea>
                    </div>
                    <button onclick="copyToClipboard()" class="btn btn-success btn-sm">
                        <i class="fas fa-copy"></i> Salin Hasil
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById("hasilTeks");
        copyText.select();
        document.execCommand("copy");
        alert("Teks berhasil disalin!");
    }
</script>

@endsection