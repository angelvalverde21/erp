<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <x-sectioncontent>

        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTasks">
            Agregar tarea
        </button>

        <div class="card  mt-3">
            <div class="card-header">
                <h3 class="card-title">Tareas pendientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 300px">Nombre</th>
                            <th>Descripcion</th>
                            <th>Progreso</th>
                            <th>Prioridad</th>
                            <th>Status</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>

                                <td><span class="badge bg-danger">Medio</span></td>
                                <td>
                                    <div class="form-check form-switch">
                                        @if ($task->active)
                                            <input class="form-check-input" wire:click="active({{ $task->id }})"
                                                type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">ACTIVO</label>
                                        @else
                                            <input class="form-check-input" wire:click="active({{ $task->id }})"
                                                type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">DESACTIVADO</label>
                                        @endif
                                    </div>
                                </td>
                                <td><a href="{{ route('manage.tasks.edit', [$store->nickname, $task->id]) }}"
                                        class="btn btn-success">Editar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </x-sectioncontent>


    <!-- Modal -->
    <div class="content-modal">
        <div class="modal fade" id="modalTasks" tabindex="-1" aria-labelledby="modalTasks" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTasks">Crear tarea</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-form.input type="text" debounce="500" wirevalue="task.name"
                            error="Este campo es requerido">
                            Nombre de la tarea
                        </x-form.input>

                        <x-form.textarea debounce="500" wirevalue="task.description">
                            Descripcion de la tarea
                        </x-form.textarea>

                        {{-- <x-form.input type="text" debounce="500" wirevalue="task.assigned_id" icon="fa-solid fa-user"
                            error="Este campo es requerido">
                            Responsable
                        </x-form.input> --}}

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form.select wirevalue="task.priority" wirevalue="task.assigned_id"
                                    icon="fa-solid fa-user" error="Este campo es requerido">

                                    <option value="0">Asignar tarea a:</option>
                                    <option value="1707">MAGALY HINOSTROZA G.</option>
                                    <option value="232">ANGEL VALVERDE A.</option>

                                </x-form.select>
                            </div>
                            <div class="col-lg-6">
                                <x-form.select wirevalue="task.priority" icon="fa-solid fa-circle-exclamation"
                                    error="Este campo es requerido">

                                    <option value="">Prioridad</option>
                                    <option value="Baja">Baja</option>
                                    <option value="Media">Media</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Urgente">Urgente</option>

                                </x-form.select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <x-form.save />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            //por el momento no pasamos nada a data, pero es necesario para el correcto funcionamiento
            Livewire.on('crearTareaExito', data => {
                console.log('se ha escuchado el envento crearTareaExito');
                console.log(data);

                var genericModalEl = document.getElementById('modalTasks')
                var modal = bootstrap.Modal.getInstance(genericModalEl)
                modal.hide()
            })
        </script>
    @endpush

</div>
