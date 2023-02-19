@props(['errors', 'input'])

@if ($errors->has($input))
    <div class="message-sm mb-4" style="background-color: var(--red)">
        <p>{{ $errors->first($input) }}</p>
    </div>
@endif
