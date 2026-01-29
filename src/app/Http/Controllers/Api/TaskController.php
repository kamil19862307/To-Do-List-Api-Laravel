<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        // Подгружаем и тех кто исполняет задачу
        return TaskResource::collection(Task::with('users')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request): JsonResponse
    {
        Task::query()->create($request->validated());

        return response()->json(['message' => 'Задача создана']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): TaskResource
    {
        // Задача + исполнители
        return new TaskResource($task->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json(['message' => 'Задача обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json('Задача удалена');
    }
}
