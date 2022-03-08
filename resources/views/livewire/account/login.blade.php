<x-layout.page-container
    :error-message="$errors->has('attempt') ? $errors->get('attempt') : null"
    heading="Log In To Wordle Group"
    title="Log In To Wordle Group"
>
    <form
        @if($codeSent)
        wire:submit.prevent="attemptLoginWithCode"
        @else
        wire:submit.prevent="send"
        @endif
        class="grid grid-cols-1 gap-y-6 w-full max-w-sm w-full mx-auto"
        x-data
        @login-code-sent.window="document.getElementById('loginCode').focus()"
    >

        @if($codeSent)

            <div class="bg-green-50 border border-green-700 mb-2 rounded text-sm px-3 py-2 text-green-800">
                We have emailed you a login code. Enter it below.
            </div>

            <x-form.input.text
                :errors="$errors"
                class="font-fixed"
                name="loginCode"
                label="Login Code"
                wire:model.lazy="loginCode"
                placeholder="123456"
            />

            <div class="col-span-1">
                <x-form.input.button type="submit" loading-action="attemptLoginWithCode" class="w-44">Log In
                </x-form.input.button>
            </div>
        @else

            <x-form.input.text
                :errors="$errors"
                name="email"
                autofocus
                label="Email Address"
                wire:model.lazy="email"
                placeholder="your@email.address"
            />

            <div class="col-span-1">
                <x-form.input.button type="submit" loading-action="send" class="w-44">Send Log In Code
                </x-form.input.button>
            </div>
        @endif

        <div class="col-span-1 pt-6 text-sm">
            <a class="link" href="{{ route('register') }}">Don't have an account? Register one here.</a>
        </div>
    </form>
</x-layout.page-container>
