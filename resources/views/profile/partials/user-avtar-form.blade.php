<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User Avtar
        </h2>
        <img src="{{'/storage/'.$user->avtar}}"  alt="User Avtar" />
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Add or Update user avtar
        </p>
    </header>

    @if (session('message'))
    <div style="color:red">
        {{ session('message')}}
    </div>
    @endif

    <form method="post" action="{{ route('profile.avtar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avtar" value="Avtar" />
            <x-text-input id="avtar" name="avtar" type="file" class="mt-1 block w-full" :value="old('avtar', $user->avtar)" required autofocus autocomplete="avtar" />
            <x-input-error class="mt-2" :messages="$errors->get('avtar')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
