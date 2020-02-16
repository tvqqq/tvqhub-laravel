@extends('layouts.app')
@section('title', '[CP] Song #' . $item->id)

@section('content')
    <div class="card">
        <div class="card-body">
            @include('layouts.msg')
            <form method="POST" action="{{ route('chinese-playlist.update', $item->id) }}">
                @csrf
                @method('PUT')
                @include('layouts.info')

                <div class="form-group">
                    <label for="cn_name">Chinese name:</label>
                    <input type="text" class="form-control" id="cn_name" name="cn_name"
                           value="{{ $item->cn_name ? $item->cn_name : old('cn_name') }}">
                </div>
                <div class="form-group">
                    <label for="vn_name">Vietnamese name:</label>
                    <input type="text" class="form-control" id="vn_name" name="vn_name"
                           value="{{ $item->vn_name ? $item->vn_name : old('vn_name') }}">
                </div>
                <div class="form-group">
                    <label for="artist">Artist:</label>
                    <input type="text" class="form-control" id="artist" name="artist"
                           value="{{ $item->artist ? $item->artist : old('artist') }}">
                </div>
                <div class="form-group">
                    <label for="mp3_url">Mp3 URL:</label>
                    <input type="text" class="form-control" id="mp3_url" name="mp3_url"
                           value="{{ $item->mp3_url ? $item->mp3_url : old('mp3_url') }}">
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label>
                    <input type="text" class="form-control" id="image_url" name="image_url"
                           value="{{ $item->image_url ? $item->image_url : old('image_url') }}">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color"
                           value="{{ $item->color ? $item->color : old('color') }}">
                </div>

                <div class="row">
                    <div class="col">
                        <a href="{{ route('chinese-playlist.') }}" class="btn btn-secondary"><i
                                class="fas fa-angle-left"></i> Back</a>
                        <span class="mx-3">|</span>
                        <button type="button" class="btn btn-danger btn-delete"
                                data-id="{{ $item->id }}">Delete
                        </button>
                    </div>
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Save <i
                                class="fas fa-upload"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                if (!confirm('Do you want to delete this item?')) {
                    return;
                }
                const route = '{{ route('chinese-playlist.destroy', ':id') }}';
                $.ajax({
                    url: route.replace(':id', $(this).data('id')),
                    method: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    }
                }).done(function () {
                    alert('Successfully deleted!');
                    window.location.href = '{{ route('chinese-playlist.') }}';
                })
            });
        });
    </script>
@endpush
