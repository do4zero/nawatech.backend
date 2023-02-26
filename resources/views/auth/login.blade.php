<x-guest-layout>
    <div class="max-w-md mx-auto">
        <x-jet-authentication-card>
            <x-slot name="logo">
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif


            <div>
                <div>
                    <img
                        src="{{ url('/logo-company.png') }}"
                        alt="Image"
                        class="h-[150px] w-[150px] mx-auto relative"
                    />
                </div>
                <div class="block pt-6 text-center font-semibold text-xl text-slate-900">
                    Welcome, Administrator
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mt-4">
                        <x-jet-input id="email" class="block mt-1 w-full bg-gray-50 focus:bg-white" type="email" name="email" :value="old('email')" required autofocus placeholder="Email"/>
                    </div>

                    <div class="mt-4">
                        <x-jet-input id="password" class="block mt-1 w-full bg-gray-50 focus:bg-white" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    </div>

                    <div class="mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="mt-4">
                        <button class="w-full text-center bg-slate-800 py-2 text-white rounded-full">
                            {{ __('Sign In') }}
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        Don't have account?
                        <a class="text-sm text-gray-600 hover:text-gray-900 relative" href="{{ route('register') }}">
                           <span class="underline">{{ __('Sign Up') }}</span>
                        </a>
                    </div>
                </form>
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>
