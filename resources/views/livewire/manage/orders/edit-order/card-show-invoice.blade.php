<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-user.button-open-modal class="success mb-3" text="Agregar Pago" icon="fa-solid fa-plus"
    target="#agregarPago" />

    @if ($order->is_pay())
        Esta pagado
    @else   
        falta pagar
    @endif

    <div class="table-responsive">
        @if ($order->payments->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px" class="text-center">#</th>
                    <th class="text-center">Imagen</th>
                    <th>Subido</th>
                    <th>Medio de pago</th>
                    <th>Monto</th>
                    <th style="width: 40px">Status</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($order->payments as $payment)
                    <tr>
                        <td class="text-center">{{ $payment->id }}</td>
                        <td class="text-center">
                            
                            <a href="{{ Storage::url($payment->image) }}" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                <img class="imagen-comprobante" src="{{ Storage::url($payment->image) }}" height="60px" alt="">
                            </a>

                        </td>
                        <td>{{ $payment->created_at }}</td>
                        <td>
                            {{ $payment->payment_method->name}}
                        </td>
                        <td>{{ $payment->amount }}</td>
                        <td><span class="badge bg-success">{{ $payment->status->title }}</span></td>
                        <td class="text-center"><button type="button" wire:loading:click wire:click="deletePayment({{ $payment->id }})" class="btn btn-danger">X</button></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @else
            <div class="alert p-3">
                No hay pagos registrados para esta orden
            </div>
        @endif
    </div>

    <x-modal title="Agregar pago" id="agregarPago">

        <x-card-upload-order post="manage.orders.upload.invoice" wirekey="a1" filename="{{ $order->photo_payment }}"
            orderid="{{ $order->id }}" store="{{ $store->nickname }}" iddrop="upload-invoice" bg="light">
            <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Vaucher de pago
        </x-card-upload-order>

        <div class="input-group mb-3">
            <span class="input-group-text">S/.</span>
            <input type="text" class="form-control" id="total_amount" value="{{ $order->total_amount }}" aria-label="">
        </div>

        <div class="payment_type mb-3">
            @include('livewire.manage.orders.edit-order._navbar-pay-method')
        </div>

        <button type="button" class="btn btn-success w-100" id="registrarPago">Registrar
            Pago</button>

        {{-- Luego de registrar el pago (enviar la imagen de la factura) luego se debe cerrar el Modal
        y posteriormente hacer un llamado emit para que se renderice toda la pagina y se pueda ver los cambios
        en tiempo real. --}}

        {{-- {{ $total_amount }} --}}

        <x-slot name="footer">

        </x-slot>

    </x-modal>


    <script>

        Dropzone.options.uploadInvoice = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "<i class=\"fas fa-camera mt-10\" style=\"font-size: 18pt;\"></i>",
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            addRemoveLinks: true,
            maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
            autoProcessQueue: false,
            maxFiles: 1,
            // uploadMultiple: true,

            init: function() {

                console.log('init');

                //Desactiva el boton
                // document.getElementById('registrarPago').setAttribute('disabled', 'disabled');

                // document.getElementById('registrarPago').setAttribute('disabled', 'disabled');

                var myDropzone = this;

                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("registrarPago").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                    console.log('registrarPago');
                    //Desactiva el boton

                });

                // send all the form data along with the files:
                // this.on("sendingmultiple", function(data, xhr, formData) {
                //     formData.append("total_amount", jQuery("#total_amount").val());
                // });

                this.on("sending", function(data, xhr, formData) {
                    formData.append("total_amount", jQuery("#total_amount").val());
                    formData.append("payment_method_id", jQuery(".payment_type #payment_method_id").val());
                    console.log('sending');
                });

                this.on("addedfile", function(data, xhr, formData) {
                    console.log('se agrego un archivo');

                    //Activa el boton para poder enviar
                    // document.getElementById("registrarPago").removeAttribute('disabled');
                    console.log('addedfile');
                });

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
                Livewire.emit('render');
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


@push('script')
    <script>
        $(document).ready(function() {
            $("#total_amount").keyup(function() {
                document.getElementById("registrarPago").removeAttribute('disabled');
            });
        });
    </script>
@endpush
