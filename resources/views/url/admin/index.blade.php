@extends('layouts.app')
@section('title', 'Short Link (URL)')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Short Link</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th width="2%">#</th>
                        <th>Slug</th>
                        <th>Origin Url</th>
                        <th>Clicks</th>
                        <th width="25%">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr class="text-center">
                            <td class="text-bold">
                                <a href="{{ route('url.show', $item) }}">{{ $item->id }}</a>
                            </td>
                            <td>{{ $item->slug }}</td>
                            <td class="text-left"><a href="{{ $item->origin_url }}" target="_blank">{{ $item->origin_url }}</a></td>
                            <td>{{ count($item->url_details) }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
