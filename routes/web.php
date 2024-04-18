<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

//Route::get('/{id}', function ($id) use ($tasks){
//    $task = collect($tasks)->firstWhere('id', $id);
//    if(!$task) {
//        abort(Response::HTTP_NOT_FOUND);
//    }
//
//    return view('show', ['task' => $task]);
//})->name('tasks.show');

Route::get('/tasks/{id}', function ($id) {
    $task = \App\Models\Task::findOrFail($id);
    return view('show', ['task' => $task]);
})->name('tasks.show');

