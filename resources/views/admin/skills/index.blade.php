<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
			<h2 class="text-xl font-semibold leading-tight">
				{{ __('Skills') }}
			</h2>
			<x-button
				href="{{ route('admin.skill.create') }}"
				variant="success"
				size="base"
				class="items-center max-w-xs gap-2"
			>
				<x-heroicon-o-plus aria-hidden="true" class="size-6" />
				<span>Create New Skill</span>
			</x-button>
		</div>
	</x-slot>

	@session('success')
		<div x-data="{ show: true }" x-show="show" role="alert" class="mb-4 relative flex w-full p-3 text-sm text-white bg-green-600 rounded-md">
			{{ $value }}
			<button @click="show = false" class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
			</button>
		</div>
	@endsession

	<table class="mb-4 p-8 w-full align-middle text-gray-300 bg-white shadow-md rounded-xl dark:bg-dark-eval-1">
		<thead class="align-bottom">
			<tr class="font-semibold text-[0.95rem] text-gray-500 uppercase">
				<th class="py-3 px-6 text-start min-w-[100px]">Skill Name</th>
				<th class="py-3 px-6 text-end min-w-[75px]">Category</th>
				<th class="py-3 px-6 text-end min-w-[50px]">Action</th>
			</tr>
		</thead>
		<tbody class="divide-y-2 divide-dark-eval-3 divide-dashed">
			@forelse ($skills as $skill)
				<tr>
					<td class="py-4 px-6">
						<div class="flex items-center gap-3">
							<div class="relative inline-block shrink-0 rounded-2xl">
								<img src="/images/{{ $skill->icon_path }}" class="size-16 inline-block shrink-0 rounded-2xl" alt="" />
							</div>
							<a class="font-semibold text-lg/normal">{{ $skill->name }}</a>
						</div>
					</td>
					<td class="py-4 px-6 text-end">
						<span class="font-semibold text-md/normal">{{ $skill->category }}</span>
					</td>
					<td class="py-4 px-6 text-end">
						<form action="{{ route('admin.skill.destroy', $skill->id) }}" method="POST" class="divide-x divide-dark-eval-2">
							<a href="{{ route('admin.skill.edit', $skill->id) }}" class="font-medium text-md/normal pr-2 text-blue-600 hover:text-blue-800">Edit</a>

							@csrf
							@method('DELETE')
							<button type="submit" class="font-medium text-md/normal pl-2 text-red-600 hover:text-red-800">Remove</button>
						</form>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="3" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">There are no data.</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	{!! $skills->withQueryString()->links('pagination::tailwind') !!}
</x-app-layout>
