<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    nama_produk: '',
    kategori: '',
    harga: '',
    stok: '',
});

const submit = () => {
    form.post(route('produk.store'));
};
</script>

<template>
    <Head title="Tambah Produk" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Tambah Produk Baru</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 p-6 sm:p-8">
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama Produk</label>
                            <input 
                                type="text" 
                                v-model="form.nama_produk" 
                                placeholder="Contoh: Laptop ASUS ROG" 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-3 px-4"
                                required
                            />
                            <div v-if="form.errors.nama_produk" class="text-red-500 text-xs mt-1">{{ form.errors.nama_produk }}</div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Kategori</label>
                            <input 
                                type="text" 
                                v-model="form.kategori" 
                                placeholder="Contoh: Elektronik / Aksesoris" 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-3 px-4"
                                required
                            />
                            <div v-if="form.errors.kategori" class="text-red-500 text-xs mt-1">{{ form.errors.kategori }}</div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Harga (Rp)</label>
                                <input 
                                    type="number" 
                                    v-model="form.harga" 
                                    placeholder="Contoh: 1500000" 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-3 px-4"
                                    required
                                />
                                <div v-if="form.errors.harga" class="text-red-500 text-xs mt-1">{{ form.errors.harga }}</div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Stok Barang</label>
                                <input 
                                    type="number" 
                                    v-model="form.stok" 
                                    placeholder="Contoh: 50" 
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-3 px-4"
                                    required
                                />
                                <div v-if="form.errors.stok" class="text-red-500 text-xs mt-1">{{ form.errors.stok }}</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <Link 
                                :href="route('produk.index')" 
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition"
                            >
                                Batal
                            </Link>
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md hover:from-green-700 hover:to-emerald-700 transition duration-200 disabled:opacity-50"
                            >
                                Simpan Produk
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>