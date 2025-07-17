<!DOCTYPE html>
<html>
<head>
    <title>Form Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tambah CSS scanner -->
    <style>
        #reader {
            width: 300px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h2>Form Absensi Anggota</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('absen.store') }}">
        @csrf
        <label>QR Code:</label>
        <input type="text" id="qr_code" name="qr_code" required readonly><br><br>

        <label>Latitude:</label>
        <input type="text" id="lat" name="latitude" readonly><br><br>

        <label>Longitude:</label>
        <input type="text" id="long" name="longitude" readonly><br><br>

        <button type="submit">Kirim Absensi</button>
    </form>

    <hr>

    <h3>Scan QR Code di Sini:</h3>
    <div id="reader"></div>

    <!-- Lib QR scanner -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        // Isi otomatis latitude dan longitude
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('long').value = position.coords.longitude;
            });
        } else {
            alert("Geolocation tidak didukung di browser ini");
        }

        // Jalankan QR Scanner
        const qrInput = document.getElementById('qr_code');
        const html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start(
            { facingMode: "environment" }, // Kamera belakang
            {
                fps: 10,    // frame per second
                qrbox: 250  // ukuran kotak scan
            },
            qrCodeMessage => {
                qrInput.value = qrCodeMessage;
                html5QrCode.stop(); // stop scanner setelah dapat QR
                alert("QR Terdeteksi: " + qrCodeMessage);
            },
            errorMessage => {
                // Bisa diabaikan / tampilkan di console
                console.warn(`QR error: ${errorMessage}`);
            }
        ).catch(err => {
            alert("Gagal buka kamera: " + err);
        });
    </script>
</body>
</html>
