<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo"> </x-slot>

        <div class="mb-4">
            <img
                src="{{ url('/logo-company.png') }}"
                alt="Image"
                class="h-[150px] w-[150px] mx-auto relative"
            />
        </div>
        <div class="mb-4 text-sm text-gray-600 text-center">
            {{
                __(
                    "Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another."
                )
            }}
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
            {{
                __(
                    "A new verification link has been sent to the email address you provided in your profile settings."
                )
            }}
        </div>
        @endif

        <div class="mt-4 flex items-center justify-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __("Resend Verification Email") }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
