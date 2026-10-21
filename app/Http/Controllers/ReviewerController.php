<?php

namespace App\Http\Controllers;

use App\Support\MockExamData;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReviewerController extends Controller
{
    public function index(): View
    {
        return view('pages.reviewer', [
            'mockExams' => MockExamData::subjects(),
            'mockQuestions' => MockExamData::questions(),
        ]);
    }

    public function download(string $subject): BinaryFileResponse
    {
        $exam = MockExamData::subjects()[$subject] ?? abort(404);
        $path = storage_path('app/mock-exams/'.$exam['pdf']);

        abort_unless(is_file($path), 404);

        return response()->download($path, $exam['pdf'], [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
