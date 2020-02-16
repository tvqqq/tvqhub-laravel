@extends('layouts.app')
@section('title', 'Chinese Playlist')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Chinese Playlist</strong>
            <a class="btn btn-outline-primary btn-sm float-right" href="{{ route('chinese-playlist.create') }}"><i
                    class="fas fa-plus-circle"></i> Add New</a>
        </div>

        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th width="2%">#</th>
                        <th>Song - Artist</th>
                        <th width="25%">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr class="text-center">
                            <td class="text-bold">
                                <a href="{{ route('chinese-playlist.show', $item) }}">{{ $item->id }}</a>
                            </td>
                            <td class="text-left">
                                {{ $item->vn_name }} ({{ $item->cn_name }}) - {{ $item->artist }}
                            </td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
