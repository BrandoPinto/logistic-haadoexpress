@if(session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>¡Éxito!</strong> {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endif

@if(session('error'))
    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fa fa-thumbs-down"></i></span>
        <span class="alert-text"><strong>¡Error!</strong> {{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endif
