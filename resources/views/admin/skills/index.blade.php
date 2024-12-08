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

	<table id="myTable" class="mb-4 p-8 w-full align-middle text-gray-300 bg-white shadow-md rounded-xl dark:bg-dark-eval-1">
		<thead class="align-bottom">
			<tr class="font-semibold text-[0.95rem] text-gray-500 uppercase">
				<th class="py-3 px-6 text-start max-w-[20px]">No.</th>
				<th class="py-3 px-6 text-start min-w-[100px]">Skill Name</th>
				<th class="py-3 px-6 text-end min-w-[75px]">Category</th>
				<th class="py-3 px-6 text-end min-w-[50px]">Action</th>
			</tr>
		</thead>
		<tbody class="divide-y-2 divide-dark-eval-3 divide-dashed">
			@forelse ($skills as $skill)
				<tr>
					<td class="py-4 px-6">
						<span>{{ $loop->iteration }}</span>
					</td>
					<td class="py-4 px-6">
						<div class="flex items-center gap-3">
							<div class="relative shrink-0 rounded-2xl">
								<img src="/images/{{ $skill->icon_path }}" class="size-16 rounded-2xl" alt="{{ $skill->name }}'s Image" />
							</div>
							<a class="font-semibold text-lg/normal">{{ $skill->name }}</a>
						</div>
					</td>
					<td class="py-4 px-6 text-end">
						<span class="font-semibold text-md/normal">{{ $skill->category }}</span>
					</td>
					<td class="py-4 px-6">
                        <div class="inline-flex items-center justify-end w-full gap-2">
                            <x-button variant="info" size="sm" href="{{ route('admin.skill.edit', $skill) }}">Edit</x-button>
                            <form action="{{ route('admin.skill.destroy', $skill) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
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
