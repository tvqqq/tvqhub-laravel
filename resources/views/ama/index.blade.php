@extends('layouts.app')
@section('title', 'AMA')

@section('content')
    <div class="card">
        <div class="card-header">AMA</div>

        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th width="2%">#</th>
                        <th>Question</th>
                        <th width="25%">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $question)
                        @php
                            if ($question->trashed())
                                $trClass = 'table-secondary';
                            elseif ($question->answer)
                                $trClass = 'table-success';
                            else
                                $trClass = '';
                        @endphp
                        <tr class="{{ $trClass }} text-center clickable-row"
                            data-href='{{ route('ama.show', $question) }}'>
                            <td>{{ $question->id }}</td>
                            <td class="text-left">{{ Str::limit($question->question, 50) }}</td>
                            <td>{{ $question->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
@endpush
