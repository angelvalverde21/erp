<div>


            <style>
                .dropzone {
                    width: 100% !important;
                    height: 150px;
                    min-height: 0px !important;
                }
        
                .dropzone .dz-message {
                    margin: 0;
                }
            </style>
        
        
            {{-- Do your work, then step back. --}}
            <div class="zoom-color text-center">
        
                <div wire:ignore class="drop-zoom" wire:key="upload-option-{{ $field }}">
                    <form method="POST" action="{{ route('manage.option.upload', [$store->nickname]) }}" class="dropzone" id="my-awesome-dropzone-upload-option-{{ $field }}">
                    </form>
                </div>
        
                <div class="preview py-3">
                    <img src="{{ $image }}" width="140px" alt="">
                </div>
        
            </div>
        
            @push('script')
            <script>
                Dropzone.options.myAwesomeDropzoneUploadOption{{ $fieldPascalCase }} = {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dictDefaultMessage: "<div>{{ $text }}</div> <i class=\"fas fa-camera mt-5\" style=\"font-size: 18pt;\"></i>",
                    acceptedFiles: "image/*",
                    paramName: "file", // The name that will be used to transfer the file
                    params: 
                        {
                            'name':'{{ $field }}',
                        },
                    maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
        
                    complete: function(file) {
                        this.removeFile(file);
                    },
                    queuecomplete: function() {
                        Livewire.emit('refreshOptionUpload');
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
