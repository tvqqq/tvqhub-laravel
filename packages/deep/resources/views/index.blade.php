@extends('deep::master')

@push('css')
    <link rel="stylesheet" href="{{ asset('packages/deep/css/jquery.modal.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('packages/deep/css/toastr.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('packages/deep/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('packages/deep/js/infinite-scroll.pkgd.min.js') }}"></script>
    <script src="{{ asset('packages/deep/js/jquery.modal.min.js') }}"></script>
    <script src="{{ asset('packages/deep/js/toastr.min.js') }}"></script>
    <script src="{{ asset('packages/deep/js/script.js') }}"></script>
@endpush

@section('content')
    <div class="grid unloaded">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        @foreach ($posts as $post)
            <div class="grid-item">
                @if ($post->type === 'image')
                    <img src="{{ $post->media }}" alt="{{ Str::limit($post->content, 120) }}" class="media-display"/>
                @elseif ($post->type === 'video')
                    <iframe src="https://www.youtube.com/embed/{{ $post->media }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                            class="media-display"></iframe>
                @endif
                {{ Illuminate\Mail\Markdown::parse($post->content) }}
                <a href="{{ route('deep.posts.show', $post->id) }}" class="view-post">
                    <span>ღ</span> {{ $post->created_at->locale('vi_VN') }}
                </a>
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}
    <div class="page-load-status">
        <div class="loader-ellips infinite-scroll-request">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
        </div>
        <p class="infinite-scroll-last">/* Hết rồi */</p>
    </div>

    @auth
        @if (auth()->user()->is_qeoqeo_user)
            <button id="new-post-button">New Post 😍</button>

            <form id="new-post" class="modal" method="post" action="{{ route('deep.posts.store') }}">
                @csrf
                <select name="type">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                </select>
                <div class="media-image media-input">
                    <input type="file" name="media-image-upload"/>
                    <small>- or -</small>
                    <input type="text" name="media-image-url" placeholder="Image URL"/>
                </div>
                <div class="media-video media-input">
                    <input type="text" name="media-video" placeholder="Video Youtube ID"/>
                </div>
                <textarea name="content" rows="20"></textarea>
                <button type="submit">Add new post 🤗</button>
            </form>
        @endif
    @endauth
@endsection
