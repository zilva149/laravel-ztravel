@props(['errors'])

@if ($errors->any())
    <div class="modal-sm mb-4" style="background-color: var(--red)">
        <p>{{ $errors->first() }}</p>
    </div>
@endif