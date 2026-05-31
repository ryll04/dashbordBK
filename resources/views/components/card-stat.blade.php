@props(['title', 'value', 'icon' => null, 'trend' => null, 'trendUp' => true, 'accentColor' => 'var(--color-primary)'])

<div class="card-stat" style="border-left-color: {{ $accentColor }};">
    <div class="flex justify-between items-center" style="margin-bottom: var(--space-xs);">
        <span class="text-caption" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
            @if($icon){!! $icon !!}@endif {{ $title }}
        </span>
    </div>
    <div class="text-heading-lg" style="margin-bottom: var(--space-xxs); color: {{ $accentColor }}; font-weight: 800;">
        {{ $value }}
    </div>
    @if($trend)
        <div class="text-caption" style="color: {{ $trendUp ? '#15803d' : '#dc2626' }}; font-weight: 600; display: flex; align-items: center; gap: 4px;">
            <span style="font-size: 10px;">{{ $trendUp ? '▲' : '▼' }}</span>
            {{ $trend }}
            <span style="font-weight: 400; color: var(--color-ash); margin-left: 2px;">vs bulan lalu</span>
        </div>
    @endif
</div>
