{{-- Alert Component --}}
{{-- Usage: @include('components.alert', ['type' => 'success', 'message' => 'Data berhasil disimpan']) --}}

@props(['type' => 'info', 'message' => '', 'dismissible' => true])

@php
    $types = [
        'success' => [
            'bg' => 'bg-green-100',
            'border' => 'border-green-400',
            'text' => 'text-green-700',
            'icon' => 'fa-check-circle'
        ],
        'error' => [
            'bg' => 'bg-red-100',
            'border' => 'border-red-400',
            'text' => 'text-red-700',
            'icon' => 'fa-exclamation-circle'
        ],
        'warning' => [
            'bg' => 'bg-yellow-100',
            'border' => 'border-yellow-400',
            'text' => 'text-yellow-700',
            'icon' => 'fa-exclamation-triangle'
        ],
        'info' => [
            'bg' => 'bg-blue-100',
            'border' => 'border-blue-400',
            'text' => 'text-blue-700',
            'icon' => 'fa-info-circle'
        ],
    ];
    
    $style = $types[$type] ?? $types['info'];
@endphp

<div 
    class="alert {{ $style['bg'] }} border-l-4 {{ $style['border'] }} {{ $style['text'] }} p-4 mb-4 rounded" 
    role="alert"
    x-data="{ show: true }"
    x-show="show"
    x-transition
>
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas {{ $style['icon'] }} mr-3 text-lg"></i>
            <div>
                @if(isset($title))
                    <p class="font-bold">{{ $title }}</p>
                @endif
                <p>{{ $message ?? $slot }}</p>
            </div>
        </div>
        
        @if($dismissible)
            <button 
                @click="show = false" 
                class="ml-4 {{ $style['text'] }} hover:opacity-75"
                aria-label="Close"
            >
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
</div>

{{-- Auto-dismiss after 5 seconds if dismissible --}}
@if($dismissible)
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
@endif
