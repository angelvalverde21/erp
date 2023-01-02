<div>

    <style>
        .dropzone {
            width: 100% !important;
            height: 75px;
            min-height: 0px !important;
        }

        .dropzone .dz-message {
            margin: 0;
        }
    </style>

    {{-- In work, do what you enjoy. --}}

    <x-user.card-upload-user wirekey="a1" filename="{{ $user->$field }}" userid="{{ $user->id }}"
        field="{{ $field }}" iddrop="my-awesome-dropzone-photo">
        {{ $field }}

    </x-user.card-upload-user>

    @push('script')
        <script>
            Livewire.on('uploadPhotoJs', (UserId, deleteFunction) => {

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
                        Livewire.emit('deleteFileProfile', UserId, deleteFunction)
                        //deleteFileProfile se encuentra en el archivo componente card-upload-user
                    }

                })

            })

            Dropzone.options.myAwesomeDropzonePhoto = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "<i class=\"fas fa-camera mt-10\" style=\"font-size: 18pt;\"></i>",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshCard');
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

</div>
