<?php

namespace Deep\Controllers;

use App\Helpers\HCloudinary;
use App\Http\Controllers\Controller;
use Deep\Models\DeepPost;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeepController extends Controller
{
    const CLOUDINARY_FOLDER = 'deep';

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $posts = DeepPost::latest()->paginate(10);

        return view('deep::index', compact('posts'));
    }

    /**
     * Display posts with type is video
     *
     * @return Factory|View
     */
    public function indexVideo()
    {
        $posts = DeepPost::where('type', 'video')->latest()->paginate(10);

        return view('deep::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->isTVQ();

        $validatedData = $request->validate([
            'type' => 'required'
        ]);

        $media = null;
        $resultCloudinary = null;
        if ($request->file('media-image-upload')) {
            $resultCloudinary = app(HCloudinary::class)->upload($request->file('media-image-upload')->getPathname(), self::CLOUDINARY_FOLDER);
        } elseif ($request->get('media-image-url')) {
            $resultCloudinary = app(HCloudinary::class)->upload($request->get('media-image-url'), self::CLOUDINARY_FOLDER);
        } else {
            $media = $request->get('media-video');
        }

        if ($resultCloudinary) {
            $media = $resultCloudinary['secure_url'];
        }

        $result = DeepPost::create([
            'type' => $request->get('type'),
            'content' => $this->replaceWithBrTag($request->get('content')),
            'media' => $media,
            'created_by' => auth()->user()->id
        ]);

        return response()->json([
            'success' => true,
            'data' => $result
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $post = DeepPost::findOrFail($id);

        return view('deep::detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->isTVQ();

        DeepPost::find($id)->update([
            'content' => $this->replaceWithBrTag($request->get('content')),
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->isTVQ();

        logger()->info('Deep post #' . $id . ' has been deleted by ' . auth()->user()->id);
        DeepPost::destroy($id);

        return response()->redirectTo('/');
    }

    /**
     * Only allow TVQ.
     */
    private function isTVQ()
    {
        try {
            $this->authorize('isTVQ', auth()->user());
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Replace character '==' with tag '<br/>' to make a line break in content
     *
     * @param string $content
     * @return string
     */
    private function replaceWithBrTag($content)
    {
        return str_replace('==', '<br/>', $content);
    }
}
