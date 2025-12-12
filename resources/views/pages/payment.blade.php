<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway - Simulasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">

    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-lg border border-gray-700">
        <div class="flex justify-between items-center mb-8 border-b border-gray-700 pb-4">
            <h2 class="text-xl font-mono text-green-400">SECURE PAYMENT</h2>
            <span class="bg-green-900 text-green-300 text-xs px-2 py-1 rounded">TEST MODE</span>
        </div>

        <div class="space-y-6">
            <div>
                <label class="block text-gray-400 text-sm mb-1">Nomor Virtual Account</label>
                <div class="text-3xl font-mono font-bold tracking-widest text-white">
                    {{ $vaNumber }}
                </div>
            </div>

            <div class="flex justify-between items-center bg-gray-700 p-4 rounded-lg">
                <span class="text-gray-300">Total Tagihan</span>
                <span class="text-xl font-bold text-yellow-400">Rp {{ number_format($amount, 0, ',', '.') }}</span>
            </div>

            <div class="bg-blue-900/30 p-4 rounded-lg border border-blue-800 text-sm text-blue-200">
                <p><strong>Instruksi Simulasi:</strong></p>
                <p>[Mode Testing] Klik tombol di bawah untuk menyetujui pembayaran secara otomatis.</p>
            </div>
        </div>

        <form action="{{ route('front.payment.post') }}" method="POST" class="mt-8">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="va_number" value="{{ $vaNumber }}">
            <input type="hidden" name="trx_id" value="{{ request('trx_id') }}">

            <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-4 rounded-lg transition transform hover:scale-105 shadow-lg">
                KONFIRMASI PEMBAYARAN
            </button>
        </form>
    </div>

</body>
</html>