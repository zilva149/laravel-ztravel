@props(['key', 'user'])

<tr class="border-b">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $key }}</td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        {{ $user->name }}
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
        &euro;{{ number_format($user->sales, 2, '.', ',') }}
    </td>
</tr>