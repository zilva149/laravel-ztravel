<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] pb-8 text-gray-900 bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex flex-col justify-start items-center"
        style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <div class="relative w-full max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex gap-6 rounded-lg border-2 shadow-lg bg-[rgba(21,34,56,0.4)] z-10">
            <form method="POST" action="{{ route('customer-payment-store', $offer->id) }}"
                class="w-3/5 p-6 grid grid-cols-4 gap-2">
                @csrf
    
                <!-- Firstname -->
                <div class="mb-6 flex flex-col gap-2 col-start-1 col-span-2">
                    <x-form.label for="firstname" :value="__('Vardas')" />
                    <x-form.input id="firstname" class="block w-full" type="text" name="firstname" :value="old('firstname')"
                        autofocus placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='firstname' />
                </div>
    
                <!-- Lastname -->
                <div class="mb-6 flex flex-col gap-2 col-start-3 col-span-2">
                    <x-form.label for="lastname" :value="__('Pavardė')" />
                    <x-form.input id="lastname" class="block w-full" type="text" name="lastname" :value="old('lastname')"
                        autofocus placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='lastname' />
                </div>
    
                <!-- Email Address -->
                <div class="mb-6 flex flex-col gap-2 col-start-1 col-span-2">
                    <x-form.label for="email" :value="__('El. paštas')" />
                    <x-form.input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                        placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='email' />
                </div>
    
                <!-- Address -->
                <div class="mb-6 flex flex-col gap-2 col-start-3 col-span-2">
                    <x-form.label for="address" :value="__('Adresas')" />
                    <x-form.input id="address" class="block w-full" type="text" name="address" :value="old('address')"
                        placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='address' />
                </div>
    
                <!-- Credit Card -->
                <div class="mb-6 flex flex-col gap-2 col-start-1 col-span-2">
                    <x-form.label for="credit_card" :value="__('Kredito kortelė')" />
                    <x-form.input id="credir_card" class="block w-full" type="text" name="credit_card" :value="old('credit_card')"
                        placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='credit_card' />
                </div>
    
                <!-- MM/YY -->
                <div class="mb-6 flex flex-col gap-2 col-start-3 col-span-1">
                    <x-form.label for="mm_yy" :value="__('MM/YY')" />
                    <x-form.input id="mm_yy" class="block w-full" type="text" name="mm_yy" :value="old('mm_yy')"
                        placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='mm_yy' />
                </div>
    
                <!-- CVC -->
                <div class="mb-6 flex flex-col gap-2 col-start-4 col-span-1">
                    <x-form.label for="cvc" :value="__('CVC')" />
                    <x-form.input id="cvc" class="block w-full" type="text" name="cvc" :value="old('cvc')"
                        placeholder="{{ __('') }}" autofocus />
                    <x-auth-validation-errors :errors="$errors" input='cvc' />
                </div>
    
                <!-- Submit Button -->
                <div class="mb-6 col-start-1 col-span-2 flex gap-4">
                    <button type="submit" class="btn-action-link w-full text-lg">Pirkti</button>
                    <a href="{{ route('customer-single-offer', $offer->id) }}" class="btn-action-link text-lg flex items-center justify-center">Grįžti</a>
                </div>
            </form>
            <div class="w-2/5 p-6 text-white flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Vietovė:</span>
                    <span>{{ $offer->destination->name }}, {{ $offer->country->name }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Nakvynės vieta:</span>
                    <span>{{ $offer->hotel->name }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Pasiūlymas:</span>
                    <span>{{ $offer->name }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Data:</span>
                    <span>{{ $offer->travel_start }} iki {{ $offer->travel_end }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Trukmė (dienomis):</span>
                    <span>{{ $offer->duration }}</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-lg font-semibold">Kaina (EUR):</span>
                    <span>{{ number_format($offer->price, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>