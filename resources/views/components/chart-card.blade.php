@props(['title', 'id', 'height' => '300px'])

<div class="card pin-card" style="padding: var(--space-xl);">
    <h3 class="text-heading-md" style="margin-bottom: var(--space-lg);">{{ $title }}</h3>
    <div style="height: {{ $height }}; position: relative;">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div>
