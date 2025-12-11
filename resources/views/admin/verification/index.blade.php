<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verifikasi Toko') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($stores->isEmpty())
                <p class="text-gray-600">Tidak ada toko yang menunggu verifikasi.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nama Toko</th>
                            <th class="px-4 py-2">Pemilik</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td class="px-4 py-2">{{ $store->name }}</td>
                                <td class="px-4 py-2">{{ $store->user->name }}</td>
                                <td class="px-4 py-2">
                                    {{ $store->is_verified ? 'Verified' : 'Pending' }}
                                </td>
                                <td class="px-4 py-2 flex gap-2">
                                    @if(!$store->is_verified)
                                        <form method="POST" action="{{ route('admin.verification.approve', $store) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.verification.reject', $store) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $stores->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>