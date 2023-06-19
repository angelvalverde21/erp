<div>
    {{-- The best athlete wants his opponent at his best. --}}

    {{-- <x-sectioncontent>

        <div class="card mt-3">
            <div class="card-header">
                <h4>Carousel (Publica)</h4>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-success my-2">Guardar Cambios</a>
            </div>
        </div>

    </x-sectioncontent> --}}

    <x-sectioncontent>

        {{-- REDES SOCIALES --}}

        <div class="card mt-3">
            <div class="card-header bg bg-secondary">
                <h4>Redes Sociales</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-brands fa-instagram"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.instagram"
                                placeholder="Instagram" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>


                    <div class="col-lg-4 col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-brands fa-facebook"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.facebook"
                                placeholder="Facebook" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>


                    <div class="col-lg-4 col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-brands fa-tiktok"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.tiktok"
                                placeholder="Tiktok" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                </div>

                {{-- el field es el campo en la coluna name de la base de datos de la tabla options  --}}
            </div>
            <div class="card-footer">
                <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                    wire.target="save" wire:click.prevent="save()" class="btn btn-success ml-auto"><i
                        class="fa-solid fa-floppy-disk mr-1"></i>
                    Guardar</button>
                {{-- <a href="#" class="btn btn-success my-2" wire:click="save()">Guardar Cambios</a> --}}
            </div>
        </div>

    </x-sectioncontent>

    <x-sectioncontent>

        {{-- INFORMACION DE LA PAGINA WEB --}}

        <div class="card mt-3">
            <div class="card-header bg bg-secondary">
                <h4>Informacion de la pagina web (Publica)</h4>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-house"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.title"
                                placeholder="Titulo de la pagina web" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-house"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.iniciales"
                                placeholder="Iniciales, Ejemplo: ARA" aria-label="Iniciales"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-earth-americas"></i></span>
                            <input type="text" class="form-control" wire:model.debounce.500ms="options.domain"
                                placeholder="dominio" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-lg-6 col-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text">S/.</span>
                            <input type="number" class="form-control" wire:model.debounce.500ms="options.ship_min"
                                placeholder="Monto minimo para envio gratis" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-lg-6 col-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-brands fa-whatsapp"></i></span>
                            <input type="number" class="form-control" wire:model.debounce.500ms="options.whatsapp"
                                placeholder="whatsapp" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>


                </div>

            </div>
            <div class="card-footer">
                <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                    wire.target="save" wire:click.prevent="save()" class="btn btn-success ml-auto"><i
                        class="fa-solid fa-floppy-disk mr-1"></i>
                    Guardar</button>
                {{-- <a href="#" class="btn btn-success my-2" wire:click="save()">Guardar Cambios</a> --}}
            </div>
        </div>
        {{-- </form> --}}

    </x-sectioncontent>

    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg bg-secondary">
                        <h4>upload_logo</h4>
                    </div>
                    <div class="card-body">
                        @livewire('components.profile.upload-option', ['store' => $store, 'field' => 'upload_logo'], key('upload_logo'))

                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg bg-secondary">
                        <h4>upload_logo_invoice</h4>
                    </div>
                    <div class="card-body">
                        @livewire('components.profile.upload-option', ['store' => $store, 'field' => 'upload_logo_invoice'], key('upload_logo_invoice'))
                    </div>
                </div>
            </div>
        </div>

    </x-sectioncontent>


    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg bg-secondary">
                        <h4>Yape</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control"
                                        wire:model.debounce.500ms="options.name_yape" placeholder="Titular Yape"
                                        aria-label="Titular yape">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-mobile-screen"></i></span>
                                    <input type="number" class="form-control"
                                        wire:model.debounce.500ms="options.phone_yape" placeholder="Telefono Yape"
                                        aria-label="Telefono yape">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-qrcode"></i></span>
                                    <textarea class="form-control" rows="3" wire:model.debounce.500ms="options.code_yape" placeholder="Codigo Yape (Opcional)"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                            wire.target="save" wire:click.prevent="save()" class="btn btn-success ml-auto mb-3"><i
                                class="fa-solid fa-floppy-disk mr-1"></i>
                            Guardar</button>

                        @livewire('components.profile.upload-option', ['store' => $store, 'field' => 'upload_qr_yape', 'text' => 'Subir Qr Yape'], key('upload_qr_yape'))

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg bg-secondary">
                        <h4>Plin</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control"
                                        wire:model.debounce.500ms="options.name_plin" placeholder="Titular Plin"
                                        aria-label="Titular Plin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-mobile-screen"></i></span>
                                    <input type="number" class="form-control"
                                        wire:model.debounce.500ms="options.phone_plin" placeholder="Telefono Plin"
                                        aria-label="Telefono Plin">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-qrcode"></i></span>
                                    <textarea class="form-control" rows="3" wire:model.debounce.500ms="options.code_plin" placeholder="Codigo Plin (Opcional)"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                        wire.target="save" wire:click.prevent="save()" class="btn btn-success ml-auto mb-3"><i
                            class="fa-solid fa-floppy-disk mr-1"></i>
                        Guardar</button>

                        @livewire('components.profile.upload-option', ['store' => $store, 'field' => 'upload_qr_plin', 'text' => 'Subir Qr Plin'], key('upload_qr_plin'))
                    </div>
                </div>
            </div>
        </div>

    </x-sectioncontent>

</div>
