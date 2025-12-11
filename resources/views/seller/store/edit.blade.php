<x-app-layout>
    <x-slot name="header">Profil Toko</x-slot>

    <div class="py-6 px-4">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nama Toko</label>
                <input type="text" name="name" id="name" value="{{ old('name', $store->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $store->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium">Logo Toko</label>
                <input type="file" name="logo" id="logo"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @if($store->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$store->logo) }}" alt="Logo Toko" class="w-24 h-24 object-cover rounded">
                    </div>
                @endif
            </div>

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-app-layout>