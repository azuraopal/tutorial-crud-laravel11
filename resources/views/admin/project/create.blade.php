<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 md:flex-row md:items-center">
			<x-button
				iconOnly="true"
				href="{{ route('admin.project.index') }}"
				size="sm"
				srText="Back to Index"
			>
				<x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
			</x-button>
			<h2 class="text-xl font-semibold leading-tight">
				{{ __('Projects') }}
			</h2>
		</div>
	</x-slot>

	<section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1">
		<header>
			<h2 class="text-lg font-semibold">Create New Project</h2>
		</header>
		<form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
			@csrf
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div class="space-y-4">
					<div class="space-y-2">
						<x-form.label
							for="inputTitle"
							:value="__('Title')"
						/>
						<x-form.input
							id="inputTitle"
							name="title"
							type="text"
							class="block w-full"
							required
							autofocus
							autocomplete="title"
						/>
						<x-form.error :messages="$errors->get('title')" />
					</div>
                    <div class="space-y-2">
						<x-form.label 
							for="inputDescription"
							:value="__('Description')"
						/>
						<textarea
							name="description"
							id="inputDescription"
							cols="35"
							rows="7"
							class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
							required
						></textarea>
						<x-form.error :messages="$errors->get('description')" />
					</div>
				</div>
				<div class="space-y-4">
                    <div class="space-y-2">
						<x-form.label
							for="inputLink"
							:value="__('Link')"
						/>
						<x-form.input
							id="inputLink"
							name="link"
							type="url"
							class="block w-full"
							autocomplete="link"
						/>
						<x-form.error :messages="$errors->get('link')" />
					</div>
					<div class="space-y-2">
						<x-form.label
							for="inputImage"
							:value="__('Image')"
						/>
						<x-form.file-input
							name="image"
							label="Upload Image"
							validFileFormats="JPEG, PNG"
							maxFileSizeMB="2"
						/>
						<x-form.error :messages="$errors->get('image')" />
					</div>
				</div>
			</div>
			<div class="mt-6">
				<x-button>
					{{ __('Submit') }}
				</x-button>
			</div>
		</form>
	</section>
</x-app-layout>
