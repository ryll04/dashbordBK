@props(['title', 'value', 'icon' => null, 'trend' => null, 'trendUp' => true])

<div class="card" style="padding: var(--space-lg);">
    <div class="flex justify-between items-center" style="margin-bottom: var(--space-sm);">
        <h3 class="text-body-sm" style="margin: 0; color: var(--color-mute);">{{ $title }}</h3>
        @if($icon)
            <div style="color: var(--color-primary);">{!! $icon !!}</div>
        @endif
    </div>
    <div class="text-heading-lg" style="margin-bottom: var(--space-xs);">
        {{ $value }}
    </div>
    @if($trend)
        <div class="text-caption" style="color: {{ $trendUp ? 'var(--color-success-deep)' : 'var(--color-error)' }}; font-weight: 600;">
            {{ $trendUp ? '↑' : '↓' }} {{ $trend }}
        </div>
    @endif
</div>
