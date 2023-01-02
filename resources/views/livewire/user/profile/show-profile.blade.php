<div>
    {{-- Success is as dangerous as failure. --}}
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-9 col-12">

                    @can('store')
                
                    <div class="card mt-3">
                        <div class="card-header">
                            <div>Perfil del propietario del negocio </div><small>Estos datos no seran publicos</small>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12 col-12">

                                    <div class="row">

                                        <div class="col-lg-12 col-12">

                                            <div class="mb-3">
                                                <x-user.input type="text" wirevalue="user.name"
                                                    icon="fa-solid fa-user" error="Este campo es requerido">
                                                    Nombre completo
                                                </x-user.input>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-12">
                                            <x-user.input type="number" wirevalue="user.dni"
                                                icon="fa-solid fa-id-badge" error="Este campo es requerido">
                                                DNI
                                            </x-user.input>
                                        </div>


                                        <div class="col-lg-6 col-12">
                                            <x-user.input type="number" wirevalue="user.phone"
                                                icon="fa-solid fa-mobile" error="Este campo es requerido">
                                                Celular
                                            </x-user.input>
                                        </div>


                                    </div>

                                    <div class="row">


                                        <div class="col-lg-6 col-12">
                                            <x-user.input type="email" wirevalue="user.email" icon="fa-solid fa-at"
                                                error="Este campo es requerido">
                                                Email
                                            </x-user.input>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <x-user.input type="date" wirevalue="user.birthday"
                                                icon="fa-solid fa-cake-candles" error="Este campo es requerido">
                                                Fecha de Nacimiento
                                            </x-user.input>
                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>

                        <div class="card-footer d-flex">
                            <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                                wire.target="save" wire:click="save" class="btn btn-primary ml-auto"><i
                                    class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>

                            <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        {{-- {{ $user }} --}}

                    </div>


                    @endcan

                    <div class="card mt-3">
                        <div class="card-header">

                            <div>Perfil del Negocio </div><small>Estos datos son publicos</small>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12 col-12">

                                    <div class="row">

                                        <div class="col-lg-12 col-12">

                                            <div class="mb-3">
                                                <x-user.input type="text" wirevalue="user.name"
                                                    icon="fa-solid fa-store" error="Escriba un nombre de la tienda">
                                                    Nombre de la tienda
                                                </x-user.input>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="number" wirevalue="user.dni" icon="fa-solid fa-mobile"
                                                error="Este campo es requerido">
                                                Telefono del negocio
                                            </x-user.input>
                                        </div>


                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="number" wirevalue="user.phone"
                                                icon="fa-brands fa-whatsapp" error="Este campo es requerido">
                                                Whatsapp del negocio
                                            </x-user.input>
                                        </div>

                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="email" wirevalue="user.email" icon="fa-solid fa-at"
                                                error="Este campo es requerido">
                                                Email del negocio
                                            </x-user.input>
                                        </div>

                                    </div>

                                    <div class="row">


                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="text" wirevalue="user.nickname"
                                                texticon="Yape" icon="fa-solid fa-link"
                                                error="este usuario esta ocupado">
                                                Url del negocio
                                            </x-user.input>
                                        </div>
                                        
                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="text" wirevalue="user.nickname"
                                                texticon="PLIN" icon="fa-solid fa-link"
                                                error="este usuario esta ocupado">
                                                Url del negocio
                                            </x-user.input>
                                        </div>

                                        <div class="col-lg-4 col-12">
                                            <x-user.input type="text" wirevalue="user.nickname"
                                                texticon="https://3b.pe/" icon="fa-solid fa-link"
                                                error="este usuario esta ocupado">
                                                Url del negocio
                                            </x-user.input>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            @livewire('user.profile.card-upload', ['user' => $this->user], key('card-upload-' . $this->user->id))
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="card-footer d-flex">
                            <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                                wire.target="save" wire:click="save" class="btn btn-primary ml-auto"><i
                                    class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>

                            <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        {{-- {{ $user }} --}}

                    </div>
                </div>


                <div class="col-lg-3 col-12">

                    <x-user.card-upload-user wirekey="foto-perfil" filename="{{ $user->profile_photo_path }}"
                        userid="{{ $user->id }}" field="profile_photo_path" iddrop="my-awesome-dropzone-photo">
                        Foto de perfil
                    </x-user.card-upload-user>

                </div>

            </div>

            <div class="row">
                <div class="col">
                    @livewire('user.profile.addresses.show-addresses', ['user' => $this->user], key('show-addresses-' . $this->user->id))
                </div>
            </div>
            

        </div>

    </section>




</div>
