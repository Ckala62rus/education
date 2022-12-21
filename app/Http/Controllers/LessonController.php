<?php

namespace App\Http\Controllers;

use App\Contracts\LessonServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends BaseController
{

    protected LessonServiceInterface $lessonRepository;

    public function __construct(LessonServiceInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * @OA\Get(
     *     path="/dashboard/lessons/",
     *     summary="Get all lessons",
     *     tags={"Lessons"},
     *     security={
     *      {"passport": {}},
     *     },
     *     @OA\Response(
     *     @OA\MediaType(
     *           mediaType="application/json",
     *      ),
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index()
    {
        $lessons = $this->lessonRepository->getAllLessons();
        return view('components.lesson.index', ['lessons' => $lessons]);
    }

    public function create()
    {
        return view('components.lesson.store');
    }

    /**
     * @OA\Post(
     *     path="/dashboard/lessons",
     *     summary="Create new lesson",
     *     tags={"Lessons"},
     *     security={
     *      {"passport": {}},
     *     },
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "Jessica Smith", "email": "test@gmail.com", "password": "123123"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $lesson = $this->lessonRepository->createLesson($request->all());
        return $this->response(
            ['lesson' => $lesson],
            'create new lesson',
            true,
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $lesson = $this->lessonRepository->getLessonById($id);
        return view('components.lesson.show', ['lesson' => $lesson]);
    }

    public function edit(int $id)
    {
        $lesson = $this->lessonRepository->getLessonById($id);
        return view('components.lesson.edit', ['lesson' => $lesson]);
    }

    public function update(Request $request, int $id)
    {
        $lesson = $this->lessonRepository->updateLesson($id, $request->all());
        return redirect()->route('lessons.index');
    }

    public function destroy($id)
    {
        //
    }
}
