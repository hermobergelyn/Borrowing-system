<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ __('Your account and login access will be permanently deleted. This action cannot be undone.') }}
            </p>

            <div class="mt-4 rounded-lg bg-red-50/90 p-4 text-sm text-red-700">
                <p class="font-medium">
                    {{ __('Please make sure you understand:') }}
                </p>

                <ul class="mt-2 list-disc space-y-1.5 pl-5">
                    <li>{{ __('You will be signed out immediately.') }}</li>
                    <li>{{ __('You will no longer be able to access this account.') }}</li>
                    <li>{{ __('Your account information will be permanently deleted.') }}</li>
                    <li>{{ __('Some records may be retained for system, financial, or audit purposes.') }}</li>
                </ul>
            </div>

            {{-- Tinanggal ko muna ang password input para sundin ang screenshot.
                 Kung kailangan pa rin ang password validation sa backend, ibalik mo lang ito. --}}
            {{--
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            --}}

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="uppercase tracking-wider text-xs"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="uppercase tracking-wider text-xs bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>