<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Http\Resources\TaskResource;

/**
 * Class TaskController
 */
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create(
            [
                //'user_id' => Auth::user()->id, TODO: after login
                'title'   => $request->title,
                'text'    => $request->text,
            ]
        );

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, string $id)
    {
        Task::where('id', $id)->update(
            $request->validated()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Task::destroy($id); // TODO: add user id after login
    }

    /**
     * @param int $id
     * @return void
     */
    public function markDone(int $id)
    {
        Task::where('id', $id)->update(['is_done' => true]);
    }
}
