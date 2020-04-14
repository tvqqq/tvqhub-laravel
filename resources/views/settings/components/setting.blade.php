<div>
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        @isset ($description)
            <h6 class="card-subtitle mb-2 text-muted">{{ $description }}</h6>
        @endisset
        {{ $slot }}
    </div>
</div>
