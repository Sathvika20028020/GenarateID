@php
    $checked = (bool) ($checked ?? false);
    $disabled = (bool) ($disabled ?? false);
    $class = $class ?? '';
    $url = $url ?? null;
@endphp

<label class="switch">
    <input
        type="checkbox"
        class="{{ $class }}"
        @checked($checked)
        @disabled($disabled)
        @if($url) data-url="{{ $url }}" @endif
    >
    <span class="slider"></span>
</label>
