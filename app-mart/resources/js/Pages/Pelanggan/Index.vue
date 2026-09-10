<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const search = ref('')

const pelanggan = ref([
    {
        id: 1,
        kode: 'PLG001',
        nama: 'Budi Santoso',
        telepon: '08123456789',
        alamat: 'Jakarta'
    },
    {
        id: 2,
        kode: 'PLG002',
        nama: 'Ani Wijaya',
        telepon: '08234567890',
        alamat: 'Bandung'
    },
    {
        id: 3,
        kode: 'PLG003',
        nama: 'Citra Dewi',
        telepon: '08345678901',
        alamat: 'Bekasi'
    },
    {
        id: 4,
        kode: 'PLG004',
        nama: 'Doni Permana',
        telepon: '08456789012',
        alamat: 'Depok'
    }
])

function hapus(id) {
    pelanggan.value =
        pelanggan.value.filter(
            item => item.id !== id
        )
}
</script>

<template>

<Head title="Pelanggan" />

<div class="page">

<nav>

<Link href="/dashboard" class="brand">
🎀 <b>TOKO ONLINE</b>
</Link>

<div class="menus">
<Link href="/dashboard">🏠 Dashboard</Link>
<Link href="/kasir">🛒 Kasir</Link>
<Link href="/produk">📦 Produk</Link>
<Link href="/transaksi">🧾 Transaksi</Link>
<Link href="/pelanggan" class="active">👥 Pelanggan</Link>
</div>

</nav>


<main>

<div class="header">

<div>
<h1>Pelanggan 👥</h1>
<p>Data pelanggan toko</p>
</div>

<button
@click="alert('Form tambah pelanggan')"
>
+ Tambah Pelanggan
</button>

</div>


<div class="card">

<input
v-model="search"
placeholder="🔎 Cari pelanggan..."
/>


<table>

<thead>
<tr>
<th>Kode</th>
<th>Nama</th>
<th>No. Telepon</th>
<th>Alamat</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<tr
v-for="item in pelanggan.filter(
p => p.nama.toLowerCase()
.includes(search.toLowerCase())
)"
:key="item.id"
>

<td>{{ item.kode }}</td>

<td>
<b>{{ item.nama }}</b>
</td>

<td>{{ item.telepon }}</td>

<td>{{ item.alamat }}</td>

<td>

<button
class="delete"
@click="hapus(item.id)"
>
Hapus
</button>

</td>

</tr>

</tbody>

</table>

</div>

</main>

</div>

</template>


<style scoped>

* {
box-sizing:border-box;
}

.page {
min-height:100vh;
background:#fff6fb;
color:#35164d;
font-family:Arial,sans-serif;
}

nav {
height:80px;
background:white;
border-bottom:1px solid #f2d3e6;
display:flex;
align-items:center;
padding:0 35px;
}

.brand {
min-width:300px;
text-decoration:none;
color:#c83e98;
font-size:18px;
}

.menus {
display:flex;
gap:8px;
}

.menus a {
text-decoration:none;
color:#765f7d;
padding:12px 16px;
border-radius:12px;
font-size:13px;
}

.menus a:hover,
.menus .active {
background:linear-gradient(135deg,#ed79bd,#a86fe6);
color:white;
}

main {
max-width:1100px;
margin:40px auto;
padding:0 20px;
}

.header {
display:flex;
justify-content:space-between;
align-items:center;
}

.header p {
color:#987e9e;
}

.header button {
border:none;
padding:12px 18px;
border-radius:10px;
background:linear-gradient(135deg,#ed79bd,#a86fe6);
color:white;
font-weight:bold;
}

.card {
margin-top:25px;
background:white;
border:1px solid #f3d1e5;
border-radius:20px;
padding:25px;
box-shadow:0 10px 25px rgba(200,100,170,.08);
}

input {
width:100%;
padding:13px;
border:1px solid #ecd4e4;
border-radius:10px;
outline:none;
margin-bottom:20px;
}

table {
width:100%;
border-collapse:collapse;
}

th,td {
padding:15px;
text-align:left;
border-bottom:1px solid #f1e2eb;
font-size:13px;
}

th {
background:#fff5fa;
color:#8f718f;
}

.delete {
border:none;
background:#ffe8f2;
color:#d63f91;
padding:7px 12px;
border-radius:8px;
cursor:pointer;
}

</style>