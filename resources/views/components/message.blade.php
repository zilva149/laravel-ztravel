@props(['size', 'operation', 'text'])

<div class="{{ $size == 'sm' ? 'message-sm' : 'message mb-4' }}" style="background-color: {{ $operation == 'success' ? 'var(--green)' : 'var(--red)' }}">
    <p>{{ $text }}</p>
</div>