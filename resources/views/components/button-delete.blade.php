@props(['action', 'buttonText' => __('Delete')])

@once
    <script>
        const handleDelete = () => {
            return {
                confirmDelete() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$refs.deleteForm.submit();
                        }
                    });
                }
            }
        }
    </script>
@endonce

<form action="{{ $action }}" method="POST" x-data="handleDelete" x-ref="deleteForm">
    @csrf
    @method('DELETE')

    <x-button variant="danger" size="sm" type="button" x-on:click="confirmDelete">
        {{ $buttonText }}
    </x-button>
</form>
