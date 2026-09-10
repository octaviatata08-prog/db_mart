<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const search = ref('')

const transaksi = ref([
    {
        id: '#001',
        pelanggan: 'Budi Santoso',
        total: 150000,
        tanggal: '08 Sep 2026',
        status: 'Selesai'
    },
    {
        id: '#002',
        pelanggan: 'Ani Wijaya',
        total: 75000,
        tanggal: '08 Sep 2026',
        status: 'Selesai'
    },
    {
        id: '#003',
        pelanggan: 'Citra Dewi',
        total: 200000,
        tanggal: '07 Sep 2026',
        status: 'Proses'
    },
    {
        id: '#004',
        pelanggan: 'Doni Permana',
        total: 50000,
        tanggal: '07 Sep 2026',
        status: 'Selesai'
    }
])

const format = value =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    }).format(value)

const filtered = computed(() =>
    transaksi.value.filter(item =>
        item.pelanggan
            .toLowerCase()
            .includes(search.value.toLowerCase())
    )
)

function detail(item) {
    alert(
        'Detail Transaksi\n\n' +
        'ID: ' + item.id + '\n' +
        'Pelanggan: ' + item.pelanggan + '\n' +
        'Total: ' + format(item.total) + '\n' +
        'Tanggal: ' + item.tanggal + '\n' +
        'Status: ' + item.status
    )
}
</script>

<template>

<Head title="Transaksi" />

<div class="page">

<nav>

<Link href="/dashboard" class="brand">
🎀 <b>TOKO ONLINE</b>
</Link>

<div class="menus">
<Link href="/dashboard">🏠 Dashboard</Link>
<Link href="/kasir">🛒 Kasir</Link>
<Link href="/produk">📦 Produk</Link>
<Link href="/transaksi" class="active">🧾 Transaksi</Link>
<Link href="/pelanggan">👥 Pelanggan</Link>
</div>

</nav>


<main>

<h1>Transaksi 🧾</h1>

<p class="subtitle">
Riwayat seluruh transaksi penjualan
</p>


<div class="card">

<input
v-model="search"
placeholder="🔎 Cari pelanggan..."
/>


<table>

<thead>
<tr>
<th>ID</th>
<th>Pelanggan</th>
<th>Total</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<tr
v-for="item in filtered"
:key="item.id"
>

<td>{{ item.id }}</td>

<td>
<b>{{ item.pelanggan }}</b>
</td>

<td>{{ format(item.total) }}</td>

<td>{{ item.tanggal }}</td>

<td>

<span
:class="item.status === 'Selesai'
? 'done'
: 'process'"
>
{{ item.status }}
</span>

</td>

<td>

<button
@click="detail(item)"
>
Detail
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

.subtitle {
color:#987e9e;
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

th,
td {
padding:15px;
text-align:left;
border-bottom:1px solid #f1e2eb;
font-size:13px;
}

th {
background:#fff5fa;
color:#8f718f;
}

.done,
.process {
padding:6px 10px;
border-radius:20px;
font-size:11px;
font-weight:bold;
}

.done {
background:#dcfce7;
color:#15803d;
}

.process {
background:#fff3cd;
color:#b45309;
}

button {
border:none;
background:#fce8f4;
color:#c53c91;
padding:8px 13px;
border-radius:8px;
cursor:pointer;
}

button:hover {
background:#ed7cbb;
color:white;
}

</style>