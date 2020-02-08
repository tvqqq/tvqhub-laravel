<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmaQuestionUpdate;
use App\Repositories\AmaQuestionRepositoryInterface;
use Illuminate\Http\Request;

class AmaQuestionController extends Controller
{
    /**
     * @var AmaQuestionRepositoryInterface
     */
    protected $repository;

    /**
     * AmaQuestionController constructor.
     * @param AmaQuestionRepositoryInterface $repository
     */
    public function __construct(AmaQuestionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show all questions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->repository->getLatestWithTrashed();

        return view('ama.index', compact('data'));
    }

    /**
     * View detail of a question.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $question = $this->repository->findWithTrashed($id);

        return view('ama.show', compact('question'));
    }

    /**
     * Answer the question.
     *
     * @param AmaQuestionUpdate $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AmaQuestionUpdate $request, int $id)
    {
        // Find a record
        $question = $this->repository->findWithTrashed($id);

        // Update with validated data
        $data = $request->validated();
        $question->update($data);

        // Return view with status
        return back()->with('status', 'Answered!');
    }

    /**
     * Soft delete a record.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $question = $this->repository->findWithTrashed($id);

        $question->delete();
    }

    /**
     * Force delete a record.
     *
     * @param int $id
     */
    public function forceDelete(int $id)
    {
        $question = $this->repository->findWithTrashed($id);

        $question->forceDelete();
    }

    /**
     * Restore a record after soft deleted.
     *
     * @param int $id
     */
    public function restore(int $id)
    {
        $question = $this->repository->findWithTrashed($id);

        $question->restore();
    }

    /**
     * Share question on Facebook.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function share(int $id)
    {
        $question = $this->repository->findWithTrashed($id);

        return view('ama.share', compact('question'));
    }
}
