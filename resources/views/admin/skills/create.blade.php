<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 md:flex-row md:items-center">
			<x-button
				iconOnly="true"
				href="{{ route('admin.skill.index') }}"
				size="sm"
				srText="Back to Index"
			>
				<x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
			</x-button>
			<h2 class="text-xl font-semibold leading-tight">
				{{ __('Skills') }}
			</h2>
		</div>
	</x-slot>

	<section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
		<header>
			<h2 class="text-lg font-semibold">Create New Skills</h2>
		</header>
		<form action="{{ route('admin.skill.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
			@csrf
			<div class="flex gap-4">
				<div class="space-y-2 flex-1">
					<x-form.label
						for="inputName"
						:value="__('Name')"
					/>
					<x-form.input
						id="inputName"
						name="name"
						type="text"
						class="block w-full"
						required
						autofocus
						autocomplete="name"
					/>
					<x-form.error :messages="$errors->get('name')" />
				</div>
				<div class="space-y-2 flex-1">
					<x-form.label
						for="inputCategory"
						:value="__('Category')"
					/>
					<x-form.input
						id="inputCategory"
						name="category"
						type="text"
						class="block w-full"
						required
						autocomplete="category"
					/>
					<x-form.error :messages="$errors->get('name')" />
				</div>
			</div>
			<x-form.file-input
				name="icon_path"
				label="Skill Icon"
				validFileFormats="JPG, JPEG, PNG, SVG"
				maxFileSizeMB="2"
			/>
			<x-button>
				{{ __('Submit') }}
			</x-button>
		</form>
	</section>
</x-app-layout>
