<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
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

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{id}', function ($id) {
    $task = Task::findOrFail($id);
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
   $data = $request->validate([
       'title' => 'required | max:255',
       'description' => 'required | max:255',
       'long_description' => 'required | max:455',
   ]);

   $task = new Task;
   $task->title = $data['title'];
   $task->description = $data['description'];
   $task->long_description = $data['long_description'];

   $task->save();

   return redirect()->route('tasks.show', ['id' => $task->id]);
})->name('tasks.store');


