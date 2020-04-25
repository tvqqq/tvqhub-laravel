@extends('deep::master')

@section('title', ' #' . $post->id)
@section('description', str_replace('<br/>', ' ', Str::limit($post->content, 120)))
@section ('ogimage')
    @if ($post->type === 'image')
        @php
            $arr = explode('upload/', $post->media);
            $arr[0] = $arr[0] . 'upload/w_400,h_400,c_fill/';
            echo trim($arr[0] . $arr[1]);
        @endphp
    @elseif ($post->type === 'video')
        @php echo 'https://img.youtube.com/vi/' . $post->media . '/0.jpg' @endphp
    @endif
@endsection

@section('content')
    <div class="detail">
        <div class="detail-col detail-content">
            @if ($post->type === 'image')
                <img src="{{ $post->media }}" alt="{{ Str::limit($post->content, 120) }}" class="media-display"/>
            @elseif ($post->type === 'video')
                <iframe src="https://www.youtube.com/embed/{{ $post->media }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                        class="media-display"></iframe>
            @endif
            <div class="content">
                {{ Illuminate\Mail\Markdown::parse(Deep::formatStyle($post->content)) }}
            </div>
            <form id="edit-post" action="{{ route('deep.posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <textarea name="content" rows="20">{{ str_replace('<br/>', '==', $post->content) }}</textarea>
                <button type="submit">Save</button>
            </form>
            <small>
                @auth
                    @if (auth()->user()->id === 1)
                        <form id="delete-post" action="{{ route('deep.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" id="edit-me">Edit</a>
                        <a href="#" id="delete-me">Delete</a>
                    @endif
                @endauth
                <span>ღ</span> {{ $post->created_at->locale('vi_VN') }}
            </small>
        </div>
        <div class="detail-col detail-social">
            <div class="fb-plugins">
                <div class="fb-like" data-href="{{ request()->url() }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div><br/>
                <div class="fb-comments" data-href="{{ request()->url() }}" data-width="" data-numposts="10"></div>
            </div>
        </div>
    </div>

    <div class="bottom">
        <a href="/">← Home</a>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            $('a#edit-me').on('click', function (e) {
                e.preventDefault();
                $('.content').css('display', 'none');
                $('#edit-post').css('display', 'block');
            });

            $('a#delete-me').on('click', function (e) {
                e.preventDefault();
                let confirmDelete = confirm('Are u sure?');
                if (confirmDelete) {
                    $('form#delete-post').submit();
                }
            });
        })
    </script>
@endpush
