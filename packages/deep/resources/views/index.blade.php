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
                {{ $post->content ? Illuminate\Mail\Markdown::parse($post->content) : '' }}
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
        <p class="infinite-scroll-last">/* The bottom of heart. */</p>
    </div>

    @auth
        @if (auth()->user()->id === 1)
            <div id="btn-new-post">
                <div class="button">
                    <span>New Post</span>
                    <svg>
                        <polyline class="o1" points="0 0, 120 0, 120 45, 0 45, 0 0"></polyline>
                        <polyline class="o2" points="0 0, 120 0, 120 45, 0 45, 0 0"></polyline>
                    </svg>
                </div>
            </div>

            <form id="new-post" class="modal" method="post" action="{{ route('deep.posts.store') }}">
                @csrf
                <select name="type" class="select-css">
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                </select>
                <div class="media-image media-input">
                    <input type="file" name="media_image_upload"/>
                    <small>- or -</small>
                    <input type="text" name="media_image_url" placeholder="Image URL"/>
                </div>
                <div class="media-video media-input">
                    <input type="text" name="media_video" placeholder="Video Youtube ID"/>
                </div>
                <textarea name="content" rows="20"></textarea>
                <button type="submit">Add new post 🤗</button>
                <button type="button" id="latest">Get latest post from Tumblr <div class="loader"></div></button>
            </form>
        @endif
    @endauth
@endsection
