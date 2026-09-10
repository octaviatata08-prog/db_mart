<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    nama_pelanggan: '',
    kota: '',
});

const submit = () => {
    form.post(route('pelanggan.store'));
};
</script>

<template>
    <Head title="Tambah Pelanggan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Pelanggan</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                            <input 
                                type="text" 
                                v-model="form.nama_pelanggan" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            />
                            <div v-if="form.errors.nama_pelanggan" class="text-red-500 text-xs mt-1">{{ form.errors.nama_pelanggan }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Kota</label>
                            <input 
                                type="text" 
                                v-model="form.kota" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            />
                            <div v-if="form.errors.kota" class="text-red-500 text-xs mt-1">{{ form.errors.kota }}</div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs uppercase font-semibold hover:bg-indigo-700">
                                Simpan
                            </button>
                            <Link :href="route('pelanggan.index')" class="text-gray-600 text-sm">Batal</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>