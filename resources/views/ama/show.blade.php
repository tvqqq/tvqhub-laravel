@extends('layouts.app')
@section('title', 'AMA Question #' . $question->id)

@section('content')
    <div class="card">
        <div class="card-body">

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

            <form method="POST" action="{{ route('ama.update', $question->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea class="form-control" id="question" rows="4"
                              disabled>{{ $question->question }}</textarea>
                </div>
                <div class="form-group">
                    <label for="created">Created at:</label>
                    <input type="text" class="form-control" id="created"
                           value="{{ $question->created_at }}" disabled>
                </div>
                <hr/>
                <div class="form-group">
                    <h4><label for="answer">Answer:</label></h4>
                    <textarea class="form-control" id="answer"
                              name="answer"
                              rows="10">{{ $question->answer ? $question->answer : old('answer') }}</textarea>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="{{ route('ama.') }}" class="btn btn-secondary"><i
                                class="fas fa-angle-left"></i> Back</a>
                        <a href="https://www.facebook.com/dialog/share?app_id=949098545458729&display=popup&href={{ route('ama.share', $question->id)  }}"
                           class="btn btn-outline-info">
                            <i class="fab fa-facebook"></i> Share
                        </a>
                        <span class="mx-3">|</span>
                        @if ($question->trashed())
                            <button type="button" class="btn btn-danger btn-force-delete">Force Delete
                            </button>
                        @else
                            <button type="button" class="btn btn-danger btn-delete"
                                    data-id="{{ $question->id }}">Delete
                            </button>
                        @endif
                    </div>
                    <div class="col text-right">
                        @if ($question->trashed())
                            <button type="button" class="btn btn-warning btn-restore">Restore <i
                                    class="fas fa-redo"></i></button>
                        @else
                            <button type="submit" class="btn btn-primary btn-lg">Update <i
                                    class="fas fa-upload"></i></button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            setTimeout(function () {
                $('.alert.alert-success').slideUp('fast');
            }, 2000);

            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                const route = '{{ route('ama.destroy', ':id') }}';
                $.ajax({
                    url: route.replace(':id', $(this).data('id')),
                    method: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    }
                }).done(function () {
                    alert('Soft Deleted!');
                    window.location.reload();
                })
            });

            $('.btn-force-delete').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('ama.forceDelete', ':id') }}',
                    method: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    }
                }).done(function () {
                    alert('Force Deleted!');
                    window.location.href = '{{ route('ama.') }}';
                })
            });

            $('.btn-restore').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('ama.restore', $question->id) }}',
                    method: 'PATCH',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    }
                }).done(function () {
                    alert('Restored!');
                    window.location.reload();
                })
            });
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/gjqpr8nkt7rvltq3k8xn74fm9yb0qbrigu0hbanmqprt5fcw/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#answer',
            plugins: ['lists, media'],
            media_live_embeds: true
        });
    </script>
@endpush
