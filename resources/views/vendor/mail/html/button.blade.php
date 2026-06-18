<div class="btn-wrapper">
    <a href="{{ $url }}"
       class="btn-primary {{ $color === 'success' ? 'btn-success' : ($color === 'error' ? 'btn-error' : '') }}"
       target="_blank"
       rel="noopener">
        {{ $slot }}
    </a>
</div>