<?php

namespace App\Services;

use App\Contracts\LessonRepositoryInterface;
use App\Contracts\LessonServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class LessonService  implements LessonServiceInterface
{
    private LessonRepositoryInterface $lessonRepository;
    private LoggerInterface $logger;

    public function __construct(
        LessonRepositoryInterface $lessonRepository,
        LoggerInterface        $logger
    )
    {
        $this->lessonRepository = $lessonRepository;
        $this->logger = $logger;
    }

    public function getLessonById(int $id): ?Model
    {
        $model = $this->lessonRepository->getById($id);

        if (!$model)
            return null;

        return $model;
    }

    public function getAllLessons(): Collection
    {
        return $this->lessonRepository->getAll();
    }

    public function createLesson(array $data): Model
    {
        return $this->lessonRepository->create($data);
    }

    public function updateLesson(int $id, array $data): ?Model
    {
        return $this->lessonRepository->update($id, $data);
    }

    public function deleteLesson(int $id): bool
    {
        return $this->lessonRepository->delete($id);
    }
}
