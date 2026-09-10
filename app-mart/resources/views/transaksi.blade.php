<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Transaksi - Toko Online</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff7fc;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        h1 {
            color: #b93691;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 18px;
            border: 1px solid #f1c5e5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0dce9;
        }

        th {
            background: #fff2fa;
            color: #a83b8b;
        }

        .success {
            color: #279b69;
            font-weight: bold;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>🧾 Transaksi</h1>

    <p>Daftar transaksi toko</p>

    <div class="card">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Gita</td>
                    <td>Rp 125.000</td>
                    <td>09-09-2026</td>
                    <td class="success">Selesai</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Aca</td>
                    <td>Rp 200.000</td>
                    <td>09-09-2026</td>
                    <td class="success">Selesai</td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Salsa</td>
                    <td>Rp 150.000</td>
                    <td>08-09-2026</td>
                    <td class="success">Selesai</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>