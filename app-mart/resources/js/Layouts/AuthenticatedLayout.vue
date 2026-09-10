<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const mobileMenu = ref(false)

const menu = [
    {
        name: 'Dashboard',
        href: '/dashboard',
        icon: '⌂'
    },
    {
        name: 'Kasir',
        href: '/kasir',
        icon: '🛒'
    },
    {
        name: 'Produk',
        href: '/produk',
        icon: '📦'
    },
    {
        name: 'Transaksi',
        href: '/transaksi',
        icon: '🧾'
    },
    {
        name: 'Pelanggan',
        href: '/pelanggan',
        icon: '👥'
    },
]
</script>

<template>
    <div class="app">

        <!-- NAVBAR ATAS -->
        <header class="navbar">

            <div class="brand">
                <div class="logo">🎀</div>

                <div>
                    <div class="brand-name">KasirKu</div>
                    <div class="brand-sub">Management System</div>
                </div>
            </div>

            <!-- MENU TENGAH -->
            <nav class="nav-menu">

                <Link
                    v-for="item in menu"
                    :key="item.name"
                    :href="item.href"
                    class="nav-item"
                    :class="{ active: $page.url === item.href }"
                >
                    <span class="nav-icon">
                        {{ item.icon }}
                    </span>

                    <span>{{ item.name }}</span>
                </Link>

            </nav>

            <!-- PROFILE -->
            <div class="profile">

                <button class="notification">
                    🔔
                    <span></span>
                </button>

                <div class="avatar">
                    G
                </div>

                <div class="profile-text">
                    <b>Gita Octavia</b>
                    <small>Administrator</small>
                </div>

            </div>

            <!-- MOBILE -->
            <button
                class="mobile-button"
                @click="mobileMenu = !mobileMenu"
            >
                ☰
            </button>

        </header>

        <!-- MOBILE MENU -->
        <div
            v-if="mobileMenu"
            class="mobile-menu"
        >
            <Link
                v-for="item in menu"
                :key="item.name"
                :href="item.href"
                @click="mobileMenu = false"
            >
                {{ item.icon }} {{ item.name }}
            </Link>
        </div>

        <!-- CONTENT -->
        <main class="main-content">
            <slot />
        </main>

        <!-- FOOTER -->
        <footer>
            💗 <b>GITA OCTAVIA</b>
            <span>• System Online</span>
            <small>v1.0.0</small>
        </footer>

    </div>
</template>

<style scoped>

* {
    box-sizing: border-box;
}

.app {
    min-height: 100vh;
    background:
        linear-gradient(
            135deg,
            #fff5f9 0%,
            #fdf7ff 50%,
            #f5f7ff 100%
        );

    color: #35243b;
}

/* ================= NAVBAR ================= */

.navbar {
    height: 82px;
    background: rgba(255,255,255,.94);
    backdrop-filter: blur(15px);

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 35px;

    border-bottom: 1px solid #f4dce9;

    position: sticky;
    top: 0;
    z-index: 100;

    box-shadow: 0 5px 25px rgba(190, 120, 160, .08);
}

/* BRAND */

.brand {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 190px;
}

.logo {
    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: linear-gradient(
        135deg,
        #ff9fc4,
        #b79aff
    );

    box-shadow: 0 7px 18px rgba(231, 126, 176, .25);

    font-size: 21px;
}

.brand-name {
    font-size: 19px;
    font-weight: 800;
    color: #38243e;
}

.brand-sub {
    font-size: 11px;
    color: #a18ca6;
}

/* NAV MENU */

.nav-menu {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 5px;
}

.nav-item {
    text-decoration: none;

    display: flex;
    align-items: center;
    gap: 7px;

    padding: 11px 15px;

    border-radius: 12px;

    color: #7e6a84;

    font-size: 13px;
    font-weight: 600;

    transition: .25s;
}

.nav-item:hover {
    background: #fff0f6;
    color: #e45c98;
    transform: translateY(-1px);
}

.nav-item.active {
    background: linear-gradient(
        135deg,
        #ff8fba,
        #a68af8
    );

    color: white;

    box-shadow:
        0 7px 18px rgba(211, 119, 172, .25);
}

.nav-icon {
    font-size: 16px;
}

/* PROFILE */

.profile {
    display: flex;
    align-items: center;
    gap: 10px;

    min-width: 190px;
    justify-content: flex-end;
}

.notification {
    border: none;
    background: #fff4f8;

    width: 38px;
    height: 38px;

    border-radius: 12px;

    cursor: pointer;

    position: relative;
}

.notification span {
    position: absolute;

    width: 7px;
    height: 7px;

    background: #ff5c83;

    border-radius: 50%;

    top: 7px;
    right: 7px;

    border: 2px solid white;
}

.avatar {
    width: 39px;
    height: 39px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    color: white;
    font-weight: bold;

    background: linear-gradient(
        135deg,
        #ff91ba,
        #9a88f5
    );
}

.profile-text {
    display: flex;
    flex-direction: column;
}

.profile-text b {
    font-size: 12px;
}

.profile-text small {
    color: #a595aa;
    font-size: 10px;
}

/* CONTENT */

.main-content {
    max-width: 1400px;

    margin: auto;

    padding: 35px 40px 25px;
}

/* FOOTER */

footer {
    text-align: center;

    padding: 20px;

    color: #9a899f;

    font-size: 12px;
}

footer b {
    color: #e65c98;
}

footer small {
    display: block;
    margin-top: 5px;
}

/* MOBILE */

.mobile-button {
    display: none;

    border: none;
    background: #fff1f7;

    width: 40px;
    height: 40px;

    border-radius: 10px;

    font-size: 20px;
}

.mobile-menu {
    background: white;
    padding: 12px 20px;

    box-shadow: 0 10px 20px rgba(0,0,0,.05);
}

.mobile-menu a {
    display: block;

    padding: 12px;

    text-decoration: none;
    color: #684d6d;

    border-radius: 10px;
}

.mobile-menu a:hover {
    background: #fff0f6;
}

@media(max-width: 1000px) {

    .nav-menu {
        gap: 0;
    }

    .nav-item {
        padding: 10px;
    }

    .nav-item span:last-child {
        display: none;
    }

    .brand,
    .profile {
        min-width: auto;
    }
}

@media(max-width: 700px) {

    .navbar {
        padding: 0 18px;
    }

    .nav-menu,
    .profile-text {
        display: none;
    }

    .mobile-button {
        display: block;
    }

    .main-content {
        padding: 25px 18px;
    }
}

</style>