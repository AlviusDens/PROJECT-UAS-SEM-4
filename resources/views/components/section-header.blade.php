@props(['icon', 'color', 'title'])

<h5 class="fw-bold text-dark mb-3 text-uppercase" style="font-size: 0.95rem; letter-spacing: 0.5px;">
    <i class="bi {{ $icon }} text-{{ $color }}"></i> {{ $title }}
</h5>