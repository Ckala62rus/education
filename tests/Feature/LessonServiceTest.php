<?php

namespace Tests\Feature;

use App\Contracts\LessonRepositoryInterface;
use App\Contracts\LessonServiceInterface;
use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     * run all test => vendor/bin/phpunit
     * run concrete test in class => clear && vendor/bin/phpunit --filter=LessonServiceTest
     * run container and run php artisan => docker exec -ti backend-education bash
     *
     * @return void
     */
    public function test_get_all_lesson_if_database_clear()
    {
        // act
        // Подготавливаем методы репозитория, которые вернут нужные нам данные
        $config = \Mockery::mock(LessonRepositoryInterface::class)->makePartial();
        $config->shouldReceive('getAll')->andReturn(Collection::make());

        // Связываем нашу подготовку с репозиторием
        $this->app->instance(LessonRepositoryInterface::class, $config);

        /** @var  LessonService $lessonService */
        $lessonService = $this->app->make(LessonService::class);

        // act
        $getAllLessons = $lessonService->getAllLessons();

        // assert
        $this->assertCount(0, $getAllLessons);
    }

    public function test_create_lesson()
    {
        // arrange
        $lessonModel = new Lesson();
        $lessonModel->title = 'new title';
        $lessonModel->description = 'some description';
        $lessonModel->text = 'lorem ipsum dollar sit amet';
        $lessonModel->save();

        // Подготавливаем методы репозитория, которые вернут нужные нам данные
        $config = \Mockery::mock(LessonRepositoryInterface::class)->makePartial();
        $config->shouldReceive('create')->andReturn($lessonModel);

        // Связываем нашу подготовку с репозиторием
        $this->instance(LessonRepositoryInterface::class, $config);

        /** @var  LessonService $myService */
        $myService = $this->app->make(LessonService::class);

        // act
        $lessonCreated = $myService->createLesson($lessonModel->toArray());

        // assert
        $this->assertEquals($lessonModel->title, $lessonCreated->title);
        $this->assertEquals($lessonModel->description, $lessonCreated->description);
        $this->assertEquals($lessonModel->text, $lessonCreated->text);
    }

    public function test_get_one_lesson_by_id()
    {
        // arrange
        $lessonModel = new Lesson();
        $lessonModel->title = 'new title';
        $lessonModel->description = 'some description';
        $lessonModel->text = 'lorem ipsum dollar sit amet';
        $lessonModel->save();

        // Подготавливаем методы репозитория, которые вернут нужные нам данные
        $config = \Mockery::mock(LessonRepositoryInterface::class)->makePartial();
        $config->shouldReceive('getById')->andReturn($lessonModel);

        // Связываем нашу подготовку с репозиторием
        $this->instance(LessonRepositoryInterface::class, $config);

        /** @var  LessonService $myService */
        $myService = $this->app->make(LessonService::class);

        // act
        $lesson = $myService->getLessonById($lessonModel->id);

        // assert
        $this->assertEquals($lessonModel->id, $lesson->id);
        $this->assertNotNull($lesson);
    }

    public function test_get_one_lesson_by_id_return_null()
    {
        // arrange
        // Подготавливаем методы репозитория, которые вернут нужные нам данные
        $config = \Mockery::mock(LessonRepositoryInterface::class)->makePartial();
        $config->shouldReceive('getById')->andReturn(null);

        // Связываем нашу подготовку с репозиторием
        $this->instance(LessonRepositoryInterface::class, $config);

        /** @var  LessonService $myService */
        $myService = $this->app->make(LessonService::class);

        // act
        $lesson = $myService->getLessonById(1);

        // assert
        $this->assertNull($lesson);
    }

    public function test_update_lesson()
    {
        // arrange
        $prepareData = [
            'title' => 'new title',
            'description' => 'some description',
            'text' => 'lorem ipsum dollar sit amet'
        ];

        // act
        $lessonCreated = $this->post('dashboard/lessons', $prepareData)->decodeResponseJson()['data']['lesson'];

        /** @var  LessonService $lessonService */
        $lessonService = $this->app->make(LessonService::class);
        $lessonUpdated = $lessonService->updateLesson($lessonCreated['id'], ['title' => 'update text']);

        // assert
        $this->assertNotEquals($lessonCreated['title'], $lessonUpdated->title);
    }

    public function test_delete_lesson_by_id_if_exist_lesson()
    {
        // arrange
        $prepareData = [
            'title' => 'new title',
            'description' => 'some description',
            'text' => 'lorem ipsum dollar sit amet'
        ];

        // act
        $lessonCreated = $this->post('dashboard/lessons', $prepareData)->decodeResponseJson()['data']['lesson'];

        /** @var  LessonService $lessonService */
        $lessonService = $this->app->make(LessonService::class);
        $lessonUpdated = $lessonService->deleteLesson($lessonCreated['id']);

        // assert
        $this->assertTrue($lessonUpdated);
    }

    public function test_delete_lesson_by_id_if_not_exist_lesson()
    {
        // arange
        /** @var  LessonService $lessonService */
        $lessonService = $this->app->make(LessonService::class);

        // act
        $lessonUpdated = $lessonService->deleteLesson(2);

        // assert
        $this->assertFalse($lessonUpdated);
    }
}
