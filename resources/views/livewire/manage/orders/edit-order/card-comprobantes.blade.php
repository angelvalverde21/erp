<div class="row">
    {{-- Do your work, then step back. --}}

    <div class="col-lg-4 col-12">
        <x-card-upload-order wirekey="a1" filename="{{ $order->photo_payment }}" orderid="{{ $order->id }}" store="{{ $store->nickname }}"
            field="photo_payment" iddrop="my-awesome-dropzone-photo" bg="light">
            <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Vaucher de pago
        </x-card-upload-order>
    </div>

    <div class="col-lg-4 col-12">
        <x-card-upload-order wirekey="a2" filename="{{ $order->photo_package }}" orderid="{{ $order->id }}" store="{{ $store->nickname }}"
            field="photo_package" iddrop="my-awesome-dropzone-photo" bg="light">
            <i class="fa-solid fa-box-open mr-2"></i> Foto del paquete
        </x-card-upload-order>
    </div>

    <div class="col-lg-4 col-12">
        <x-card-upload-order wirekey="a3" filename="{{ $order->photo_delivery }}" orderid="{{ $order->id }}" store="{{ $store->nickname }}"
            field="photo_delivery" iddrop="my-awesome-dropzone-photo" bg="light">
            <i class="fa-solid fa-file-signature mr-2"></i> Comprobante de envio
        </x-card-upload-order>
    </div>

</div>

{{-- SCRIPT CUANDO CARGAR EL ARCHIVO  --}}

@push('script')
    <script>
        Dropzone.options.myAwesomeDropzonePhoto = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "<i class=\"fas fa-camera mt-10\" style=\"font-size: 18pt;\"></i>",
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
            params: { 
                current
            }
            ,
            // params: {
            //     "cordenandas" : JSON.stringify(getCordenada()) // Your gallery Id
            // },
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('refreshOrder');
                // Livewire.emit('registrarCordenada', 
                //         getPosition()
                //         .then((position) => {
                //             console.log(JSON.stringify(getCoordenadaSuccess(position)));
                //         })
                //         .catch((error) => {
                //             console.log(JSON.stringify(getCoordenadaError(error)));
                //         });
                // );
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    </script>
@endpush

{{-- SCRIPT CUANDO SE QUIERE BORRAR EL ARCHIVO  --}}

@push('script')
    <script>
        Livewire.on('deletePhotoOrderJs', (OrderId, deleteFunction) => {

            Swal.fire({
                title: 'Esta seguro?',
                text: "De borrar el comprobante",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Si'
            }).then((result) => {

                if (result.isConfirmed) {
                    Swal.fire(
                        'Borrado!',
                        'El archivo ha sido borrado',
                        'success'
                    );
                    //console.log('borrado');
                    //OJO "deletePhotoOrder" se encuentra en componente de este archivo 
                    Livewire.emit('deletePhotoOrder', OrderId, deleteFunction)
                }

            })

        })
    </script>
@endpush


