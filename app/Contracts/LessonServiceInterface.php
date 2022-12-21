<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface LessonServiceInterface
{
    public function getLessonById(int $id): ?Model;
    public function getAllLessons(): Collection;
    public function createLesson(array $data): Model;
    public function updateLesson(int $id, array $data): ?Model;
    public function deleteLesson(int $id): bool;
}
