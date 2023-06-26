<?php

namespace App\Http\Livewire\Manage\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowTasks extends Component
{

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'task.name' => 'required',
        'task.assigned_id' => 'required',
        'task.description' => '',
        'task.priority' => 'required',
    ];

    public $task, $store, $user;

    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {

        $this->store = Request::get('store');
        $this->user = Auth::user();
    }

    public function save()
    {

        Log::info('guardando');

        // try {

        Log::info($this->task);

        $this->validate($this->rules);

        $task = new Task();


        $task->name = $this->task['name'];
        $task->assigned_id = $this->task['assigned_id'];
        $task->priority = $this->task['priority'];

        if (isset($this->task['description'])) {
            $task->description = $this->task['description'];
        }


        $task->owner_id = $this->user->id;
        $task->store_id = $this->store->id;

        $task->save();



        $this->emit('crearTareaExito');
        $this->emit('creado');

        // } catch (\Throwable $th) {
        //     Log::info('no se paso la validacion');
        // }
    }

    public function active(Task $task)
    {
        Log::info('function active');

        if ($task->active) {
            $task->active = 0;
        } else {
            $task->active = 1;
        }
        
        $task->save();
    }

    public function render()
    {

        $tasks = Task::orderBy('id','desc')->get();

        return view('livewire.manage.tasks.show-tasks', compact('tasks'))->layout('layouts.manage');
    }
}
