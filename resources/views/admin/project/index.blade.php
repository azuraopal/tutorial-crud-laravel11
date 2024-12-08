<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Projects') }}
            </h2>
            <x-button href="{{ route('admin.project.create') }}" variant="success" size="base"
                class="items-center max-w-xs gap-2">
                <x-heroicon-o-plus aria-hidden="true" class="size-6" />
                <span>Create New Project</span>
            </x-button>
        </div>
    </x-slot>

    <table id="myTable"
        class="mb-4 p-8 w-full align-middle text-gray-300 bg-white shadow-md rounded-xl dark:bg-dark-eval-1">
        <thead class="align-bottom">
            <tr class="font-semibold text-[0.95rem] text-gray-500 uppercase">
                <th class="py-3 px-6 text-start max-w-[20px]">No.</th>
                <th class="py-3 px-6 text-start min-w-[100px]">Title</th>
                <th class="py-3 px-6 text-start min-w-[100px]">Description</th>
                <th class="py-3 px-6 text-center min-w-[75px]">Link</th>
                <th class="py-3 px-6 text-start min-w-[5px]">Image</th>
                <th class="py-3 px-6 text-center min-w-[50px]">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y-2 divide-dark-eval-3 divide-dashed">
            @forelse ($projects as $project)
                <tr>
                    <td class="py-4 px-6">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <a class="font-semibold text-lg/normal">{{ $project->title }}</a>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="font-semibold text-md/normal">{{ Str::limit($project->description, 50) }}</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        @if ($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-blue-500 hover:underline">
                                View Project
                            </a>
                        @else
                            <span>No link provided</span>
                        @endif
                    </td>
                    <td>
                        <div class="relative shrink-0 items-center justify-center rounded-2xl">
                            <img src="{{ asset('/storage/' . $project->image) }}" class="size-16 rounded-2xl"
                                alt="{{ $project->title }}'s Image" />
                        </div>
                    </td>

                    <td class="py-4 px-6">
                        <div class="inline-flex items-center justify-center w-full gap-2">
                            <x-button variant="info" size="sm" href="{{ route('admin.project.edit', $project) }}">Edit</x-button>
                            <form action="{{ route('admin.project.destroy', $project) }}" method="POST" class="inline">
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
                    <td colspan="5" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">There
                        are no data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {!! $projects->withQueryString()->links('pagination::tailwind') !!}
</x-app-layout>
