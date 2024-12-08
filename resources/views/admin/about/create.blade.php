<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <x-button iconOnly="true" href="{{ route('admin.about.index') }}" size="sm" srText="Back to Index">
                <x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
            </x-button>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('About') }}
            </h2>
        </div>
    </x-slot>

    <section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
        <header>
            <h2 class="text-lg font-semibold">Create New About</h2>
        </header>
        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex gap-4">
                <div class="space-y-2 flex-1">
                    <x-form.label for="inputTitle" :value="__('Title')" />
                    <x-form.input id="inputTitle" name="title" type="text" class="block w-full" required autofocus
                        autocomplete="title" />
                    <x-form.error :messages="$errors->get('title')" />
                </div>
                <div class="space-y-2 flex-1">
                    <x-form.label for="inputDescription" :value="__('Description')" />
                    <x-form.input id="inputDescription" name="description" type="text" class="block w-full" required
                        autocomplete="description" />
                    <x-form.error :messages="$errors->get('description')" />
                </div>
            </div>
            <x-form.file-input name="image" label="Image" :value="__('Image')" validFileFormats="JPG, JPEG, PNG, SVG"
                maxFileSizeMB="2" />
            <x-button>
                {{ __('Submit') }}
            </x-button>
        </form>
    </section>
</x-app-layout>
