<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <x-button iconOnly="true" href="{{ route('admin.certificate.index') }}" size="sm" srText="Back to Index">
                <x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
            </x-button>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Certificates') }}
            </h2>
        </div>
    </x-slot>

    <section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
        <header>
            <h2 class="text-lg font-semibold">Edit Certificate</h2>
        </header>
        <form action="{{ route('admin.certificate.update', $certificate->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="space-y-2 flex-1">
                    <x-form.label for="inputName" :value="__('Name')" />
                    <x-form.input id="inputName" name="name" type="text"
                        value="{{ old('name', $certificate->name) }}" class="block w-full" required autofocus
                        autocomplete="name" />
                    <x-form.error :messages="$errors->get('name')" />
                </div>
                <div class="space-y-2 flex-1">
                    <x-form.label for="inputIssuedBy" :value="__('Issued By')" />
                    <x-form.input id="inputIssuedBy" name="issued_by" type="text"
                        value="{{ old('issued_by', $certificate->issued_by) }}" class="block w-full" required />
                    <x-form.error :messages="$errors->get('issued_by')" />
                </div>
            </div>

            <div class="flex gap-4">
                <div class="space-y-2 flex-1">
                    <x-form.label for="inputDescription" :value="__('Description')" />
                    <textarea name="description" id="inputDescription" cols="35" rows="7"
                        class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">{{ old('description', $certificate->description) }}</textarea>
                    <x-form.error :messages="$errors->get('description')" />
                </div>

                <x-form.file-input name="file" label="File (PDF)" validFileFormats="PDF" maxFileSizeMB="5"
                    class="flex-1" />
                <x-form.error :messages="$errors->get('file')" />
            </div>

            <x-button>
                {{ __('Submit') }}
            </x-button>
        </form>
    </section>
</x-app-layout>
