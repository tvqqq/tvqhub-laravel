@extends('layouts.app')
@section('title', 'URL /' . $item->slug)

@section('content')
    <div class="card">
        <div class="card-body">
            @include('layouts.msg')
            <form method="POST" action="{{ route('url.update', $item->id) }}">
                @csrf
                @method('PUT')
                @include('layouts.info')

                <div class="row">
                    <div class="col-4">
                        @include('layouts.input', ['field' => 'slug'])
                    </div>
                    <div class="col-8">
                        @include('layouts.input', ['field' => 'origin_url'])
                    </div>
                </div>
                @include('layouts.input', ['field' => 'note', 'type' => 'textarea'])
            </form>
            @include('url.admin.detail')
        </div>
    </div>
@endsection
