<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-user.button-open-modal class="success mb-3" text="Agregar" icon="fa-solid fa-plus"
    target="#agregarComprobantesEnvio" />

    {{-- @if ($order->comprobantesEnvio->count())
        {{ $order->comprobantesEnvio->count() }}
    @else
        No hay comprobantes de envio
    @endif --}}

    <div class="table-responsive">
        @if ($order->comprobantesEnvio->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th class="text-center">Imagen</th>
                        <th>Subido</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->comprobantesEnvio as $comprobante)
                        <tr>
                            <td>{{ $comprobante->id }}</td>
                            <td class="text-center"><img class="imagen-comprobante" src="{{ Storage::url('uploads/'.$comprobante->name) }}" height="60px" alt="">
                            <td>{{ $comprobante->created_at }}</td>
                            </td>
                            <td class="text-center"><button type="button" wire:loading:click
                                    wire:click="deleteComprobante({{ $comprobante->id }})" class="btn btn-danger">X</button></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="alert p-3">
                No hay comprobantes de empaque para esta orden
            </div>
        @endif
    </div>

    <x-modal title="Agregar pago" id="agregarComprobantesEnvio">

        <x-card-upload-order size="modal-lg" post="manage.orders.upload.comprobantes.envio" wirekey="a1" filename="{{ $order->photo_payment }}"
            orderid="{{ $order->id }}" store="{{ $store->nickname }}" iddrop="upload-comprobantes-envio" bg="light">
            <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Adjuntar comprobantes
        </x-card-upload-order>

        {{-- Luego de registrar el pago (enviar la imagen de la factura) luego se debe cerrar el Modal
        y posteriormente hacer un llamado emit para que se renderice toda la pagina y se pueda ver los cambios
        en tiempo real. --}}

        {{-- {{ $total_amount }} --}}

        <x-slot name="footer">

        </x-slot>

    </x-modal>


    <script>

        Dropzone.options.uploadComprobantesEnvio = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "<i class=\"fas fa-camera mt-10\" style=\"font-size: 18pt;\"></i>",
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            addRemoveLinks: true,
            maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
            // autoProcessQueue: false, //espara que no se envie automaticamente, pero en este casi si deseamos eso
            // maxFiles: 1,
            // uploadMultiple: true,

            init: function() {

                console.log('init');

                var myDropzone = this;

            },

            complete: function(file) {
                this.removeFile(file);
                console.log('complete');

            },
            queuecomplete: function() {
                Livewire.emit('refreshOrder');
                console.log('queuecomplete');
                // document.getElementById('registrarPago').setAttribute('disabled', 'disabled');
            },

            accept: function(file, done) {

                console.log('accept');

                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    </script>

</div>