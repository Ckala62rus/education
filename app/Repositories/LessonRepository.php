<?php

namespace App\Repositories;

use App\Contracts\LessonRepositoryInterface;
use App\Contracts\LessonServiceInterface;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    private Builder $query;

    public function __construct()
    {
        $this->model = new Lesson();
    }
}
