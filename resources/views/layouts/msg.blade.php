@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (isset($errors))
    @foreach ($errors->all() as $message)
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endforeach
@endif
