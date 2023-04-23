<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-user.button-open-modal class="success mb-3" text="Agregar" icon="fa-solid fa-plus"
        target="#agregarComprobantes" />

    <div class="table-responsive">
        @if ($order->comprobantesEmpaque->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px" class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th>Subido</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->comprobantesEmpaque as $comprobante)
                        <tr>
                            <td class="text-center">{{ $comprobante->id }}</td>
                            <td class="text-center"><img class="imagen-comprobante" src="{{ Storage::url($comprobante->name) }}" height="60px" alt="">
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

    <x-modal title="Agregar pago" id="agregarComprobantes">

        <x-card-upload-order size="modal-lg" post="manage.orders.upload.comprobantes.empaque" wirekey="a1"
            filename="{{ $order->photo_payment }}" orderid="{{ $order->id }}" store="{{ $store->nickname }}"
            iddrop="upload-comprobantes-empaque" bg="light">
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
        Dropzone.options.uploadComprobantesEmpaque = {
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

                // for Dropzone to process the queue (instead of default form behavior):
                // document.getElementById("registrarPago").addEventListener("click", function(e) {
                //     // Make sure that the form isn't actually being sent.
                //     e.preventDefault();
                //     e.stopPropagation();
                //     myDropzone.processQueue();
                //     console.log('registrarPago');
                //     //Desactiva el boton

                // });

                // send all the form data along with the files:
                // this.on("sendingmultiple", function(data, xhr, formData) {
                //     formData.append("total_amount", jQuery("#total_amount").val());
                // });

                // this.on("sending", function(data, xhr, formData) {
                //     formData.append("total_amount", jQuery("#total_amount").val());
                //     formData.append("payment_method_id", jQuery(".payment_type #payment_method_id").val());
                //     console.log('sending');
                // });

                // this.on("addedfile", function(data, xhr, formData) {
                //     console.log('se agrego un archivo');
                //     console.log('addedfile');
                // });

                // eventos
                // queuecomplete
                // sendingmultiple
                // sending

                //desactiva el boton 
                // document.getElementById('registrarPago').setAttribute('disabled', 'disabled');

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

    {{-- <script>
        Dropzone.options.uploadInvoice = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            dictDefaultMessage: "<i class=\"fas fa-camera mt-10\" style=\"font-size: 18pt;\"></i>",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: 5,
            maxFilesize: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            paramName: "file",

            init: function() {

                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("registrarPago").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });

                //send all the form data along with the files:
                this.on("sendingmultiple", function(data, xhr, formData) {
                    formData.append("total_amount", jQuery("#total_amount").val());
                });

            },

            complete: function(file) {

            },

            queuecomplete: function() {
                // $('#agregarPago').modal().hide();
                Livewire.emit('refreshOrder');
            },

            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        }
    </script> --}}

</div>
