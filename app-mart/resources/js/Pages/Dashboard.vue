<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>

<Head title="Dashboard" />

<AuthenticatedLayout>

    <!-- HEADER -->

    <section class="welcome">

        <div>
            <span class="label">✨ OVERVIEW</span>

            <h1>Dashboard</h1>

            <p>
                Selamat datang kembali, Admin! Kelola toko kamu dengan mudah 💗
            </p>
        </div>

        <Link href="/kasir" class="kasir-button">
            🛒 Buka Kasir
        </Link>

    </section>


    <!-- STATISTIK -->

    <section class="stats">

        <div class="stat-card pink">

            <div>
                <small>Total Pendapatan</small>

                <h2>Rp 475.000</h2>

                <span class="up">
                    ↗ 12.5% dari bulan lalu
                </span>
            </div>

            <div class="stat-icon">
                💰
            </div>

        </div>


        <div class="stat-card purple">

            <div>
                <small>Total Transaksi</small>

                <h2>4</h2>

                <span class="up">
                    Transaksi bulan ini
                </span>
            </div>

            <div class="stat-icon">
                🧾
            </div>

        </div>


        <div class="stat-card peach">

            <div>
                <small>Produk Terjual</small>

                <h2>45</h2>

                <span class="up">
                    +8 produk hari ini
                </span>
            </div>

            <div class="stat-icon">
                📦
            </div>

        </div>


        <div class="stat-card blue">

            <div>
                <small>Pelanggan Baru</small>

                <h2>23</h2>

                <span class="up">
                    +5 minggu ini
                </span>
            </div>

            <div class="stat-icon">
                👥
            </div>

        </div>

    </section>


    <!-- MENU CEPAT -->

    <section class="quick-menu">

        <Link href="/kasir" class="quick-card">
            <div class="quick-icon">🛒</div>

            <div>
                <b>Kasir</b>
                <small>Buat transaksi baru</small>
            </div>

            <span>›</span>
        </Link>


        <Link href="/produk" class="quick-card">
            <div class="quick-icon">📦</div>

            <div>
                <b>Produk</b>
                <small>Kelola produk toko</small>
            </div>

            <span>›</span>
        </Link>


        <Link href="/pelanggan" class="quick-card">
            <div class="quick-icon">👥</div>

            <div>
                <b>Pelanggan</b>
                <small>Kelola pelanggan</small>
            </div>

            <span>›</span>
        </Link>


        <Link href="/transaksi" class="quick-card">
            <div class="quick-icon">🧾</div>

            <div>
                <b>Transaksi</b>
                <small>Lihat semua transaksi</small>
            </div>

            <span>›</span>
        </Link>

    </section>


    <!-- GRAFIK -->

    <section class="chart-card">

        <div class="chart-header">

            <div>
                <span class="label">STATISTIK</span>

                <h2>Grafik Penjualan</h2>

                <p>Performa penjualan toko minggu ini</p>
            </div>

            <select>
                <option>Minggu ini</option>
                <option>Bulan ini</option>
            </select>

        </div>

        <div class="chart">

            <div class="chart-line line1"></div>
            <div class="chart-line line2"></div>
            <div class="chart-line line3"></div>
            <div class="chart-line line4"></div>

            <div class="bars">

                <div class="bar-item">
                    <div class="bar" style="height:45%"></div>
                    <span>Sen</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:65%"></div>
                    <span>Sel</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:52%"></div>
                    <span>Rab</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:80%"></div>
                    <span>Kam</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:70%"></div>
                    <span>Jum</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:92%"></div>
                    <span>Sab</span>
                </div>

                <div class="bar-item">
                    <div class="bar" style="height:75%"></div>
                    <span>Min</span>
                </div>

            </div>

        </div>

    </section>


    <!-- TRANSAKSI TERBARU -->

    <section class="transaction-card">

        <div class="section-header">

            <div>
                <h2>Transaksi Terbaru</h2>
                <p>Daftar transaksi terbaru toko</p>
            </div>

            <Link href="/transaksi">
                Lihat Semua →
            </Link>

        </div>


        <div class="table">

            <div class="table-head">
                <span>#</span>
                <span>Pelanggan</span>
                <span>Total</span>
                <span>Tanggal</span>
                <span>Status</span>
            </div>


            <div class="table-row">
                <span>#001</span>
                <b>Budi Santoso</b>
                <span>Rp 150.000</span>
                <span>08 Sep 2026</span>
                <i class="success">Selesai</i>
            </div>

            <div class="table-row">
                <span>#002</span>
                <b>Ani Wijaya</b>
                <span>Rp 75.000</span>
                <span>08 Sep 2026</span>
                <i class="success">Selesai</i>
            </div>

            <div class="table-row">
                <span>#003</span>
                <b>Citra Dewi</b>
                <span>Rp 200.000</span>
                <span>07 Sep 2026</span>
                <i class="process">Proses</i>
            </div>

            <div class="table-row">
                <span>#004</span>
                <b>Doni Permana</b>
                <span>Rp 50.000</span>
                <span>07 Sep 2026</span>
                <i class="success">Selesai</i>
            </div>

        </div>

    </section>

</AuthenticatedLayout>

</template>


<style scoped>

.welcome {
    background: white;

    border: 1px solid #f6dce9;

    border-radius: 22px;

    padding: 30px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 8px 30px rgba(198, 120, 165, .08);

    margin-bottom: 20px;
}

.label {
    color: #ed6fa6;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1.5px;
}

.welcome h1 {
    margin: 7px 0;

    font-size: 30px;

    color: #38243e;
}

.welcome p {
    margin: 0;

    color: #9a899f;

    font-size: 13px;
}

.kasir-button {
    text-decoration: none;

    padding: 13px 20px;

    border-radius: 12px;

    color: white;

    font-size: 13px;
    font-weight: 700;

    background: linear-gradient(
        135deg,
        #ff8db8,
        #a38af4
    );

    box-shadow: 0 8px 18px rgba(218, 119, 169, .25);
}

/* STAT */

.stats {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 15px;

    margin-bottom: 18px;
}

.stat-card {
    background: white;

    border-radius: 18px;

    padding: 20px;

    display: flex;

    justify-content: space-between;

    border: 1px solid #f6e5ed;

    box-shadow: 0 7px 25px rgba(180, 110, 150, .06);
}

.stat-card small {
    color: #9a8aa0;

    font-size: 10px;
}

.stat-card h2 {
    margin: 8px 0;

    font-size: 21px;

    color: #39283f;
}

.up {
    color: #41ae87;

    font-size: 10px;
}

.stat-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    font-size: 20px;
}

.pink .stat-icon {
    background: #fff0f6;
}

.purple .stat-icon {
    background: #f2efff;
}

.peach .stat-icon {
    background: #fff4e8;
}

.blue .stat-icon {
    background: #edf5ff;
}

/* QUICK */

.quick-menu {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 15px;

    margin-bottom: 20px;
}

.quick-card {
    background: white;

    border: 1px solid #f5e4ec;

    border-radius: 17px;

    padding: 15px;

    display: flex;

    align-items: center;

    gap: 12px;

    text-decoration: none;

    color: #39283f;

    transition: .2s;
}

.quick-card:hover {
    transform: translateY(-3px);

    box-shadow: 0 10px 25px rgba(211, 120, 169, .12);

    border-color: #f1b9d2;
}

.quick-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #fff1f7;
}

.quick-card b {
    display: block;

    font-size: 13px;
}

.quick-card small {
    color: #a494aa;

    font-size: 10px;
}

.quick-card > span {
    margin-left: auto;

    color: #d2b5c6;

    font-size: 20px;
}

/* CHART */

.chart-card,
.transaction-card {
    background: white;

    border: 1px solid #f5e3ec;

    border-radius: 20px;

    padding: 25px;

    box-shadow: 0 8px 30px rgba(190, 110, 150, .06);

    margin-bottom: 20px;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-header h2,
.section-header h2 {
    margin: 6px 0;

    font-size: 17px;
}

.chart-header p,
.section-header p {
    margin: 0;

    font-size: 11px;

    color: #a091a5;
}

.chart-header select {
    padding: 9px 12px;

    border: 1px solid #f0dce7;

    border-radius: 10px;

    background: white;

    color: #806d85;

    outline: none;
}

.chart {
    height: 230px;

    margin-top: 25px;

    position: relative;

    overflow: hidden;
}

.chart-line {
    position: absolute;

    left: 0;
    right: 0;

    border-top: 1px dashed #f0e3e9;
}

.line1 {
    top: 15%;
}

.line2 {
    top: 40%;
}

.line3 {
    top: 65%;
}

.line4 {
    top: 90%;
}

.bars {
    position: absolute;

    left: 0;
    right: 0;
    bottom: 0;

    height: 90%;

    display: flex;

    justify-content: space-around;

    align-items: flex-end;
}

.bar-item {
    height: 100%;

    display: flex;

    flex-direction: column;

    justify-content: flex-end;

    align-items: center;

    gap: 9px;
}

.bar {
    width: 32px;

    border-radius:
        9px 9px 3px 3px;

    background:
        linear-gradient(
            to top,
            #ff8eb8,
            #c19bf8
        );

    box-shadow:
        0 6px 15px rgba(221, 126, 177, .2);
}

.bar-item span {
    font-size: 10px;

    color: #a594aa;
}

/* TABLE */

.section-header {
    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 20px;
}

.section-header a {
    text-decoration: none;

    color: #e15c98;

    font-size: 11px;

    font-weight: bold;
}

.table-head,
.table-row {
    display: grid;

    grid-template-columns:
        .5fr 2fr 1.5fr 1.5fr 1fr;

    align-items: center;

    gap: 15px;

    padding: 14px 10px;

    font-size: 11px;
}

.table-head {
    background: #fff7fa;

    color: #a18e9f;

    border-radius: 10px;
}

.table-row {
    border-bottom: 1px solid #f6edf1;

    color: #705f76;
}

.table-row b {
    color: #49374e;
}

.table-row i {
    font-style: normal;

    width: fit-content;

    padding: 5px 10px;

    border-radius: 20px;

    font-size: 9px;
    font-weight: bold;
}

.success {
    background: #e3f8ed;
    color: #27a36d;
}

.process {
    background: #fff1cf;
    color: #bd8514;
}

@media(max-width: 1000px) {

    .stats,
    .quick-menu {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 650px) {

    .welcome {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .stats,
    .quick-menu {
        grid-template-columns: 1fr;
    }

    .table {
        overflow-x: auto;
    }

    .table-head,
    .table-row {
        min-width: 650px;
    }
}

</style>