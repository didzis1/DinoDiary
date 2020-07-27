<!-- Go through errors and display them if needed -->
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger mt-3">

        {{ $error }}
    </div>
    @endforeach
@endif

<!-- Display error message -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Display success message -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif