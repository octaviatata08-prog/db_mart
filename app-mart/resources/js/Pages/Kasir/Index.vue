<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const produk = ref([
    { id: 1, nama: 'Tumbler', harga: 75000, stok: 10 },
    { id: 2, nama: 'Totebag', harga: 50000, stok: 15 },
    { id: 3, nama: 'Notebook', harga: 35000, stok: 20 },
    { id: 4, nama: 'Pulpen', harga: 10000, stok: 30 },
    { id: 5, nama: 'Botol Minum', harga: 65000, stok: 8 }
])

const keranjang = ref([])
const selected = ref('')
const jumlah = ref(1)
const uangBayar = ref(0)

const format = (value) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    }).format(value)

const total = computed(() =>
    keranjang.value.reduce(
        (sum, item) => sum + item.harga * item.jumlah,
        0
    )
)

const kembalian = computed(() =>
    Math.max(0, uangBayar.value - total.value)
)

function tambahProduk() {
    const item = produk.value.find(
        p => p.id == selected.value
    )

    if (!item) return

    const ada = keranjang.value.find(
        p => p.id === item.id
    )

    if (ada) {
        ada.jumlah += Number(jumlah.value)
    } else {
        keranjang.value.push({
            ...item,
            jumlah: Number(jumlah.value)
        })
    }

    selected.value = ''
    jumlah.value = 1
}

function hapusProduk(id) {
    keranjang.value =
        keranjang.value.filter(
            item => item.id !== id
        )
}

function prosesTransaksi() {

    if (keranjang.value.length === 0) {
        alert('Keranjang masih kosong!')
        return
    }

    if (uangBayar.value < total.value) {
        alert('Uang pembayaran masih kurang!')
        return
    }

    alert(
        'Transaksi berhasil!\nKembalian: ' +
        format(kembalian.value)
    )

    keranjang.value = []
    uangBayar.value = 0
}
</script>

<template>

<Head title="Kasir" />

<div class="page">

    <!-- NAVBAR -->

    <nav>

        <Link href="/dashboard" class="brand">
            🎀 <b>TOKO ONLINE</b>
        </Link>

        <div class="menus">

            <Link href="/dashboard">
                🏠 Dashboard
            </Link>

            <Link href="/kasir" class="active">
                🛒 Kasir
            </Link>

            <Link href="/produk">
                📦 Produk
            </Link>

            <Link href="/transaksi">
                🧾 Transaksi
            </Link>

            <Link href="/pelanggan">
                👥 Pelanggan
            </Link>

        </div>

    </nav>


    <main>

        <h1>Kasir 🛒</h1>

        <p class="subtitle">
            Buat transaksi penjualan baru
        </p>


        <div class="layout">

            <!-- PRODUK -->

            <section class="card">

                <h2>Tambah Produk</h2>

                <p>Pilih produk yang ingin dibeli</p>

                <label>Produk</label>

                <select v-model="selected">
                    <option value="">
                        -- Pilih Produk --
                    </option>

                    <option
                        v-for="item in produk"
                        :key="item.id"
                        :value="item.id"
                    >
                        {{ item.nama }} -
                        {{ format(item.harga) }}
                    </option>
                </select>


                <label>Jumlah</label>

                <input
                    v-model="jumlah"
                    type="number"
                    min="1"
                />


                <button @click="tambahProduk">
                    + Tambahkan ke Keranjang
                </button>

            </section>


            <!-- KERANJANG -->

            <section class="card">

                <h2>Keranjang 🛒</h2>

                <div
                    v-if="keranjang.length === 0"
                    class="empty"
                >
                    Keranjang masih kosong
                </div>


                <div
                    v-for="item in keranjang"
                    :key="item.id"
                    class="cart-item"
                >

                    <div>
                        <b>{{ item.nama }}</b>

                        <small>
                            {{ item.jumlah }} ×
                            {{ format(item.harga) }}
                        </small>
                    </div>

                    <div>
                        <b>
                            {{ format(item.harga * item.jumlah) }}
                        </b>

                        <button
                            class="delete"
                            @click="hapusProduk(item.id)"
                        >
                            ×
                        </button>
                    </div>

                </div>


                <hr>

                <label>Pelanggan</label>

                <input
                    placeholder="Pelanggan Umum"
                />


                <div class="total">

                    <span>Total</span>

                    <b>
                        {{ format(total) }}
                    </b>

                </div>


                <label>Uang Bayar</label>

                <input
                    v-model="uangBayar"
                    type="number"
                    placeholder="Masukkan uang pembayaran"
                />


                <div class="total">

                    <span>Kembalian</span>

                    <b class="green">
                        {{ format(kembalian) }}
                    </b>

                </div>


                <button
                    class="process"
                    @click="prosesTransaksi"
                >
                    💗 Proses Transaksi
                </button>

            </section>

        </div>

    </main>

</div>

</template>


<style scoped>

* {
    box-sizing: border-box;
}

.page {
    min-height: 100vh;
    background: #fff6fb;
    color: #35164d;
    font-family: Arial, sans-serif;
}

nav {
    height: 80px;
    background: white;
    border-bottom: 1px solid #f2d3e6;

    display: flex;
    align-items: center;

    padding: 0 35px;
}

.brand {
    text-decoration: none;
    color: #c83e98;

    font-size: 18px;

    min-width: 300px;
}

.menus {
    display: flex;
    gap: 8px;
}

.menus a {
    text-decoration: none;

    color: #765f7d;

    padding: 12px 16px;

    border-radius: 12px;

    font-size: 13px;
}

.menus a:hover,
.menus .active {
    background: linear-gradient(
        135deg,
        #ed79bd,
        #a86fe6
    );

    color: white;
}

main {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
}

h1 {
    margin-bottom: 5px;
}

.subtitle {
    color: #987e9e;
}

.layout {
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    gap: 20px;
    margin-top: 25px;
}

.card {
    background: white;
    padding: 25px;

    border-radius: 20px;

    border: 1px solid #f3d1e5;

    box-shadow: 0 10px 25px rgba(200,100,170,.08);
}

.card h2 {
    margin-top: 0;
}

.card p {
    color: #a080a2;
    font-size: 12px;
}

label {
    display: block;

    margin-top: 18px;
    margin-bottom: 7px;

    font-size: 12px;
}

select,
input {
    width: 100%;

    padding: 13px;

    border: 1px solid #ecd4e4;

    border-radius: 10px;

    outline: none;
}

select:focus,
input:focus {
    border-color: #dc70b6;
}

button {
    width: 100%;

    border: none;

    margin-top: 20px;

    padding: 13px;

    border-radius: 10px;

    color: white;

    background: linear-gradient(
        135deg,
        #eb75bb,
        #a76ee3
    );

    cursor: pointer;

    font-weight: bold;
}

button:hover {
    opacity: .9;
}

.empty {
    text-align: center;

    padding: 30px;

    color: #a78da8;
}

.cart-item {
    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 15px 0;

    border-bottom: 1px solid #f1e2eb;
}

.cart-item small {
    display: block;

    color: #9d829f;

    margin-top: 5px;
}

.delete {
    width: 30px;

    padding: 5px;

    margin: 5px 0 0 10px;

    background: #ffe7f1;

    color: #d84d98;
}

.total {
    display: flex;

    justify-content: space-between;

    margin-top: 18px;

    font-size: 15px;
}

.total b {
    color: #c23c94;
}

.green {
    color: #24a47d !important;
}

.process {
    margin-top: 25px;
}

@media(max-width: 800px) {

    nav {
        padding: 0 10px;
    }

    .brand {
        min-width: auto;
    }

    .menus {
        overflow-x: auto;
    }

    .layout {
        grid-template-columns: 1fr;
    }

}

</style>