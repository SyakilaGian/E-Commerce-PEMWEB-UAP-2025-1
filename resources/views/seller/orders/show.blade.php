<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        {{-- Info Pesanan --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pesanan</h3>
            <p><strong>Kode Pesanan:</strong> {{ $order->id }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->grand_total) }}</p>
            <p><strong>Resi:</strong> {{ $order->resi ?? '-' }}</p>
        </div>

        {{-- Detail Produk --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Produk dalam Pesanan</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Produk</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Jumlah</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Harga</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($order->details as $detail)
                        <tr>
                            <td class="px-4 py-2">{{ $detail->product->name }}</td>
                            <td class="px-4 py-2">{{ $detail->quantity }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($detail->price) }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($detail->price * $detail->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Update Status Pesanan --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Update Status Pesanan</h3>
            <form action="{{ route('seller.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="pending" @selected($order->status === 'pending')>Pending</option>
                        <option value="processing" @selected($order->status === 'processing')>Processing</option>
                        <option value="shipped" @selected($order->status === 'shipped')>Shipped</option>
                        <option value="completed" @selected($order->status === 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="resi" class="block text-sm font-medium text-gray-700">Nomor Resi</label>
                    <input type="text" name="resi" id="resi" value="{{ $order->resi }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Masukkan nomor resi (opsional)">
                </div>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>