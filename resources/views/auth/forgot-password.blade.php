<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">

            <!-- Title -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">
                    Reset Password
                </h2>
                <p class="text-sm text-gray-600">
                    Enter your email and we’ll send you a reset link
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label
                        for="email"
                        :value="__('Email Address')"
                        class="text-sm font-semibold text-gray-700 mb-1"
                    />

                    <x-text-input
                        id="email"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition bg-gray-50"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        placeholder="you@example.com"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-lg hover:from-indigo-700 hover:to-purple-700 transition transform hover:-translate-y-0.5"
                >
                    Send Reset Link
                </button>

                <!-- Back to Login -->
                <p class="text-center text-sm text-gray-600 pt-3">
                    Remember your password?
                    <a
                        href="{{ route('login') }}"
                        class="font-semibold text-indigo-600 hover:underline"
                    >
                        Back to login
                    </a>
                </p>
            </form>

            <!-- Footer -->
            <div class="mt-6 pt-4 border-t text-xs text-gray-500 text-center">
                Secure password recovery • We respect your privacy
            </div>

        </div>
    </div>
</x-guest-layout>
