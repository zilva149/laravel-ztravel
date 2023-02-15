<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-[url('/public/assets/img/bg-profile.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-end">
        <header class="relative mb-36 flex flex-col gap-16 items-center bg-transparent z-99">
            <h1 class="text-white text-5xl font-semibold text-center">Paskyra</h1>
            <a href="#profile"
                class="btn-action-link px-0 py-0 w-[70px] h-[70px] text-3xl text-white rounded-full flex justify-center items-center animate-pulse">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="max-w-3xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col gap-8 items-center" id="profile">
        <div class="w-full p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg">
            <div class="w-full text-center">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="w-full p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg">
            <div class="w-full text-center">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="w-full p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg">
            <div class="w-full">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </section>
</x-fro-layout>