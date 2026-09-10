<script setup>
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

const namaToko = ref('GITA OCTAVIA STORE')
const email = ref('admin@gita-store.com')
const telepon = ref('081234567890')
const alamat = ref('Indonesia')

const simpan = () => {
    alert('Pengaturan berhasil disimpan!')
}
</script>

<template>

<Head title="Pengaturan" />

<AuthenticatedLayout>

    <div class="title">
        <h1>Pengaturan</h1>
        <p>Kelola informasi aplikasi dan toko</p>
    </div>

    <div class="settings">

        <div class="card">

            <h2>Informasi Toko</h2>

            <label>Nama Toko</label>
            <input v-model="namaToko">

            <label>Email</label>
            <input v-model="email">

            <label>Nomor Telepon</label>
            <input v-model="telepon">

            <label>Alamat</label>
            <textarea v-model="alamat"></textarea>

            <button @click="simpan">
                Simpan Perubahan
            </button>

        </div>

        <div class="card">

            <h2>Status Sistem</h2>

            <div class="status">
                <span>●</span>
                <div>
                    <b>System Online</b>
                    <small>Aplikasi berjalan normal</small>
                </div>
            </div>

            <div class="info">
                <span>Versi Aplikasi</span>
                <b>1.0.0</b>
            </div>

            <div class="info">
                <span>Database</span>
                <b>Connected</b>
            </div>

            <div class="info">
                <span>Environment</span>
                <b>Local</b>
            </div>

        </div>

    </div>

</AuthenticatedLayout>
</template>

<style scoped>

.title {
    margin-bottom: 20px;
}

.title h1 {
    margin: 0;
}

.title p {
    color: #829ab1;
}

.settings {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 20px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,.05);
}

.card h2 {
    margin-top: 0;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #d9e2ec;
    border-radius: 8px;
    outline: none;
}

textarea {
    min-height: 100px;
}

.card > button {
    margin-top: 20px;
    padding: 12px 18px;
    border: none;
    border-radius: 8px;
    color: white;
    background: linear-gradient(135deg,#667eea,#764ba2);
    cursor: pointer;
}

.status {
    display: flex;
    gap: 12px;
    align-items: center;
    background: #ecfdf5;
    padding: 15px;
    border-radius: 10px;
    color: #15803d;
}

.status span {
    font-size: 25px;
}

.status small {
    display: block;
    color: #57936c;
    margin-top: 4px;
}

.info {
    display: flex;
    justify-content: space-between;
    padding: 17px 0;
    border-bottom: 1px solid #edf2f7;
    font-size: 13px;
}

.info span {
    color: #829ab1;
}

@media(max-width:800px) {
    .settings {
        grid-template-columns: 1fr;
    }
}
</style>