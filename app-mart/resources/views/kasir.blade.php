@extends('layouts.app')

@section('title', 'POS Kasir')

@section('content')
<div class="container-fluid mt-3">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="navbar-custom rounded">
                <h3><i class="fas fa-store me-2"></i>POS Kasir</h3>
                <div class="date-time">
                    <i class="far fa-calendar-alt me-1"></i> {{ date('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Daftar Produk -->
        <div class="col-md-8">
            <h5 class="mb-3"><i class="fas fa-box me-2"></i>Daftar Produk</h5>
            <div class="row">
                @php
                    $products = [
                        ['id' => 1, 'nama' => 'Produk 1', 'harga' => 10000],
                        ['id' => 2, 'nama' => 'Produk 2', 'harga' => 10000],
                        ['id' => 3, 'nama' => 'Produk 3', 'harga' => 10000],
                        ['id' => 4, 'nama' => 'Produk 4', 'harga' => 10000],
                        ['id' => 5, 'nama' => 'Produk 5', 'harga' => 10000],
                        ['id' => 6, 'nama' => 'Produk 6', 'harga' => 15000],
                        ['id' => 7, 'nama' => 'Produk 7', 'harga' => 20000],
                        ['id' => 8, 'nama' => 'Produk 8', 'harga' => 25000],
                    ];
                @endphp

                @foreach($products as $product)
                <div class="col-md-3 col-6 mb-3">
                    <div class="card card-product p-3 text-center" onclick="tambahProduk({{ $product['id'] }}, '{{ $product['nama'] }}', {{ $product['harga'] }})">
                        <div class="product-icon">
                            <i class="fas fa-box fa-3x text-primary"></i>
                        </div>
                        <h6 class="mt-2 mb-1">{{ $product['nama'] }}</h6>
                        <p class="text-success fw-bold mb-0">Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Keranjang Belanja -->
        <div class="col-md-4">
            <div class="cart-sidebar">
                <h5><i class="fas fa-shopping-cart me-2"></i>Keranjang</h5>
                <hr>
                <div id="cart-items" style="max-height: 350px; overflow-y: auto;">
                    <p class="text-muted text-center">Belum ada produk</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Total:</span>
                    <span class="total-price" id="total-price">Rp 0</span>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-success" onclick="prosesTransaksi()">
                        <i class="fas fa-check me-2"></i>Proses Transaksi
                    </button>
                    <button class="btn btn-danger" onclick="clearCart()">
                        <i class="fas fa-trash me-2"></i>Hapus Semua
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];
let total = 0;

function tambahProduk(id, nama, harga) {
    // Cek apakah produk sudah ada di keranjang
    const existing = cart.find(item => item.id === id);
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ id, nama, harga, qty: 1 });
    }
    updateCart();
}

function updateCart() {
    const cartContainer = document.getElementById('cart-items');
    const totalElement = document.getElementById('total-price');
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-muted text-center">Belum ada produk</p>';
        totalElement.textContent = 'Rp 0';
        return;
    }

    let html = '';
    total = 0;
    
    cart.forEach((item, index) => {
        const subtotal = item.harga * item.qty;
        total += subtotal;
        
        html += `
            <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                <div>
                    <strong>${item.nama}</strong>
                    <br>
                    <small>Rp ${item.harga.toLocaleString('id-ID')} x ${item.qty}</small>
                </div>
                <div>
                    <span class="fw-bold text-primary">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    <button class="btn btn-sm btn-danger ms-2" onclick="hapusItem(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    cartContainer.innerHTML = html;
    totalElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function hapusItem(index) {
    cart.splice(index, 1);
    updateCart();
}

function clearCart() {
    if (confirm('Yakin ingin menghapus semua produk?')) {
        cart = [];
        updateCart();
    }
}

function prosesTransaksi() {
    if (cart.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }
    
    const totalBayar = total;
    alert(`Transaksi berhasil!\nTotal: Rp ${totalBayar.toLocaleString('id-ID')}\nTerima kasih!`);
    
    // Reset keranjang setelah transaksi
    cart = [];
    updateCart();
}
</script>
@endsection