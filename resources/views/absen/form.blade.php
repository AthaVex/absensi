<!DOCTYPE html> <html lang="id"> <head> <meta charset="UTF-8"> <title>Form Absensi</title> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Tailwind CDN --> <script src="https://cdn.tailwindcss.com"></script> </head> <body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

<div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">📲 Form Absensi Anggota</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('absen.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">QR Code</label>
            <input type="text" id="qr_code" name="qr_code" readonly required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" id="lat" name="latitude" readonly
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" id="long" name="longitude" readonly
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 focus:outline-none">
            </div>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            Kirim Absensi
        </button>
    </form>
</div>

<div class="mt-8 bg-white p-6 rounded-lg shadow w-full max-w-md text-center">
    <h3 class="text-lg font-semibold mb-4">📷 Scan QR Code di Bawah Ini</h3>
    <div id="reader" class="border border-gray-300 rounded-md overflow-hidden w-full mx-auto"></div>
</div>

<!-- QR Code Scanner -->
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
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        qrCodeMessage => {
            qrInput.value = qrCodeMessage;
            html5QrCode.stop();
            alert("QR Terdeteksi: " + qrCodeMessage);
        },
        errorMessage => {
            console.warn("QR error: ", errorMessage);
        }
    ).catch(err => {
        alert("Gagal membuka kamera: " + err);
    });
</script>
</body> </html>