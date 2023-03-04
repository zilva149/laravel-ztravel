<x-back-layout :$pageTitle>
    <x-slot name="header">
    </x-slot>

    <section
        class="mb-6 p-6 rounded-md bg-white shadow-md grid grid-cols-1 gap-4 dark:bg-dark-eval-1 md:grid-cols-2 2xl:grid-cols-4">
        <x-back.home-link url="{{ route('admin-countries') }}" title='Šalys' class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-destinations') }}" title='Vietovės'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-hotels') }}" title='Nakvynės vietos'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-reviews') }}" title='Atsiliepimai'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
    </section>

    <div class="mb-6 flex flex-col gap-6 2xl:flex-row dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-8 2xl:w-2/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">Užsakymai</h3>
                <a href="{{ route('admin-orders') }}" class="btn-primary">Peržiūrėti
                    visus</a>
            </div>
            @if (isset($orders)  && count($orders) != 0)
                @foreach ($orders as $order)
                    <x-back.order-card :$order :$statusOptions  />
                @endforeach
            @else
                <p class="w-full text-xl font-semibold text-center">Nėra užsakymų</p>
            @endif
        </section>
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 2xl:w-1/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">TOP vartotojai</h3>
                <a href="{{ route('admin-users') }}" class="btn-primary">Peržiūrėti
                    visus</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Vardas
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Suma
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <x-back.home-user :$key :$user />
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-back-layout>
