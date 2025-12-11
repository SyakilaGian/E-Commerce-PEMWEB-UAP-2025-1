<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topup Saldo - KariSya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Isi Saldo Wallet</h1>
        
        <form action="{{ route('front.topup.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Masukkan nominal pengisian saldo</label>
                <input type="number" name="amount" min="10000" class="w-full p-3 border rounded-lg focus:ring-blue-500" placeholder="Minimal Rp 10.000" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                Lanjut ke Pembayaran &rarr;
            </button>
            
            <a href="/" class="block text-center mt-4 text-gray-500 hover:text-gray-700">Batal</a>
        </form>
    </div>

</body>
</html>