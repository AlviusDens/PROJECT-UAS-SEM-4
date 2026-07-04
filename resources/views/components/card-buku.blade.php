@props(['book'])

<div class="col">
    <div class="card h-100 border-0 shadow-sm transition-hover" style="border-radius: 8px; overflow: hidden;">
        <div style="height: 180px; background: #eee;" class="d-flex flex-column align-items-center justify-content-center text-muted bg-light">
            @if($book->image)
            <img src="{{ asset('storage/books/' . $book->image) }}" class="w-100 h-100" style="object-fit: cover;">
            @else
            <i class="bi bi-file-earmark-pdf text-danger mb-1" style="font-size: 2rem;"></i>
            <span style="font-size: 0.7rem;" class="text-uppercase fw-bold">{{ $book->type_display }}</span>
            @endif
        </div>
        <div class="card-body p-2 text-center d-flex flex-column justify-content-between">
            <div>
                <h6 class="fw-bold mb-0 text-truncate small" title="{{ $book->title }}">{{ $book->title }}</h6>
                @if(isset($book->author))
                <small class="text-muted d-block text-truncate mb-2">Oleh: {{ $book->author }}</small>
                @endif
                @if(isset($book->total_download))
                <span class="badge bg-light text-dark border my-1" style="font-size: 0.65rem;"><i class="bi bi-download text-success"></i> {{ $book->total_download }}x unduh</span>
                @endif
            </div>
            @if(session()->has('user_role'))
            <form action="{{ route('library.download', $book->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-xs btn-primary py-1 w-100"><i class="bi bi-download"></i> Unduh PDF</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-xs btn-light text-primary border py-1 w-100" style="font-size: 0.65rem;"><i class="bi bi-lock"></i> Login untuk Unduh</a>
            @endif
        </div>
    </div>
</div>