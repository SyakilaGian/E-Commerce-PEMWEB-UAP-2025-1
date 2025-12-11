<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Toko') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('store.register.submit') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Toko -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Toko</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Logo</label>
                        <input type="file" name="logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('logo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="about" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('about')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rekening Bank -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rekening Bank</label>
                        <input type="text" name="bank_account" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('bank_account')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Daftar Toko
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>