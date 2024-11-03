@if (Session::has('success'))
    <script type="module">
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true,
        })
    </script>
@endif

@if (Session::has('error'))
    <script type="module">
        Swal.fire({
            title: "Oops...",
            text: "{{ session('error') }}",
            icon: "error",
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true,
        })
    </script>
@endif
