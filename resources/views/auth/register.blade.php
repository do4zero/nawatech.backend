<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div class="mb-4">
            <img
                src="{{ url('/logo-company.png') }}"
                alt="Image"
                class="h-[150px] w-[150px] mx-auto relative"
            />
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="shop_name" value="{{ __('Shop Name') }}" />
                <x-jet-input id="shop_name" class="block mt-1 w-full" type="text" name="shop_name" :value="old('shop_name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="shop_address" value="{{ __('Shop Address') }}" />
                <x-jet-input id="shop_address" class="block mt-1 w-full" type="text" name="shop_address" :value="old('shop_address')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="shop_contact" value="{{ __('Shop Contact Number') }}" />
                <x-jet-input id="shop_contact" class="block mt-1 w-full" type="text" name="shop_contact" :value="old('shop_contact')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Owner Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<style>
    .myimage{
        position:relative;
        margin: 0 auto;
        height: 150px;
        border-radius: 10px;
    }
</style>
