<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Laravel" />

    <div class="relative min-h-screen bg-[#f8fafc] selection:bg-red-500 selection:text-white">
        <!-- Tombol Login & Register -->
        <div v-if="canLogin || canRegister" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <Link
                v-if="canLogin"
                :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 transition"
            >
                Log in
            </Link>

            <Link
                v-if="canRegister"
                :href="route('register')"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 transition"
            >
                Register
            </Link>
        </div>

        <div class="relative max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto">
                    <path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8895 14.8858V53.2869C61.8895 53.7193 61.6119 54.1052 61.1985 54.2655L31.6502 64.9123C31.2561 65.0655 30.8177 65.0589 30.4285 64.8975L0.710346 54.2547C0.300948 54.0937 0.0264041 53.7096 0.0264041 53.2801V14.8947C0.0264041 14.8035 0.0386063 14.7156 0.062073 14.6307L15.1526 0.184873C15.5606 -0.22542 16.2195 -0.22542 16.6275 0.184873L31.7416 15.299L46.8254 0.184873C47.2335 -0.22542 47.8923 -0.22542 48.3003 0.184873L61.8548 14.6253Z" fill="#FF2D20" />
                    <path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8895 14.8858V53.2869C61.8895 53.7193 61.6119 54.1052 61.1985 54.2655L31.6502 64.9123C31.2561 65.0655 30.8177 65.0589 30.4285 64.8975L0.710346 54.2547C0.300948 54.0937 0.0264041 53.7096 0.0264041 53.2801V14.8947C0.0264041 14.8035 0.0386063 14.7156 0.062073 14.6307L15.1526 0.184873C15.5606 -0.22542 16.2195 -0.22542 16.6275 0.184873L31.7416 15.299L46.8254 0.184873C47.2335 -0.22542 47.8923 -0.22542 48.3003 0.184873L61.8548 14.6253Z" fill="url(#paint0_linear)" />
                    <defs>
                        <linearGradient id="paint0_linear" x1="61.8895" y1="14.6253" x2="0.0264041" y2="54.2547" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF2D20" />
                            <stop offset="1" stop-color="#F43F5E" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="https://laravel.com/docs" class="group relative block">
                    <div class="relative overflow-hidden rounded-lg bg-white p-6 h-full border border-gray-200 shadow-sm transition hover:border-red-500">
                        <h3 class="text-lg font-semibold text-gray-900">Documentation</h3>
                        <p class="mt-4 text-sm text-gray-600">Laravel has wonderful documentation covering every aspect of the framework...</p>
                    </div>
                </a>
                <a href="https://laracasts.com" class="group relative block">
                    <div class="relative overflow-hidden rounded-lg bg-white p-6 h-full border border-gray-200 shadow-sm transition hover:border-red-500">
                        <h3 class="text-lg font-semibold text-gray-900">Laracasts</h3>
                        <p class="mt-4 text-sm text-gray-600">Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript...</p>
                    </div>
                </a>
                <a href="https://laravel-news.com" class="group relative block">
                    <div class="relative overflow-hidden rounded-lg bg-white p-6 h-full border border-gray-200 shadow-sm transition hover:border-red-500">
                        <h3 class="text-lg font-semibold text-gray-900">Laravel News</h3>
                        <p class="mt-4 text-sm text-gray-600">Laravel News is a community driven portal and newsletter aggregating all the latest...</p>
                    </div>
                </a>
                <a href="https://laravel.com/ecosystem" class="group relative block">
                    <div class="relative overflow-hidden rounded-lg bg-white p-6 h-full border border-gray-200 shadow-sm transition hover:border-red-500">
                        <h3 class="text-lg font-semibold text-gray-900">Vibrant Ecosystem</h3>
                        <p class="mt-4 text-sm text-gray-600">Laravel's robust library of first-party tools and services...</p>
                    </div>
                </a>
            </div>

            <div class="mt-16 text-center text-sm text-gray-500">
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </div>
        </div>
    </div>
</template>