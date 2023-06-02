@props([
    'type' => $attributes->get('type') ?? 'button',
    'disabled' => null,
    'confirm' => null,
    'confirmAction' => null,
    'tooltip' => null,
])
@isset($tooltip)
    <div class="tooltip tooltip-warning" data-tip="{{ $tooltip }}">
    @endisset
    @if ($type === 'submit')
        <button {{ $attributes }} type="submit" @if ($disabled !== null) disabled @endif
            @isset($confirm)
        x-on:click="toggleConfirmModal('{{ $confirm }}', '{{ explode('(', $confirmAction)[0] }}')"
    @endisset
            @isset($confirmAction)
        x-on:{{ explode('(', $confirmAction)[0] }}.window="$wire.{{ explode('(', $confirmAction)[0] }}"
    @endisset>
            <span wire:target="submit" wire:loading.delay class="loading loading-spinner"></span>
            {{ $slot }}
        </button>
    @elseif($type === 'button')
        <button {{ $attributes }} @if ($disabled !== null) disabled @endif type="button"
            @isset($confirm)
        x-on:click="toggleConfirmModal('{{ $confirm }}', '{{ explode('(', $confirmAction)[0] }}')"
    @endisset
            @isset($confirmAction)
        x-on:{{ explode('(', $confirmAction)[0] }}.window="$wire.{{ explode('(', $confirmAction)[0] }}"
    @endisset>
            <span wire:target="{{ explode('(', $attributes->whereStartsWith('wire:click')->first())[0] }}"
                wire:loading.delay class="loading loading-spinner"></span>
            {{ $slot }}
        </button>
    @endif

    @isset($tooltip)
    </div>
@endisset
