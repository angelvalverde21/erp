<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6 col-12">
                <x-cardsave title="Perfil del Negocio" titlesmall="Estos datos son publicos">
                    <div class="row">

                        <div class="col-lg-12 col-12">

                            <div class="mb-3">
                                <x-form.input type="text" wirevalue="user.name" icon="fa-solid fa-store"
                                    error="Escriba un nombre de la tienda">
                                    Nombre de la tienda
                                </x-form.input>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <x-form.input type="text" wirevalue="user.nickname" texticon="https://3b.pe/"
                                icon="fa-solid fa-link" error="este usuario esta ocupado">
                                Url del negocio
                            </x-form.input>
                        </div>

                        {{-- <div class="col-lg-12 col-12">
                            <x-form.input type="number" wirevalue="user.phone" icon="fa-solid fa-mobile"
                                error="Este campo es requerido o ya esta siendo usado por otro usuario">
                                Telefono del negocio
                            </x-form.input>
                        </div>

                        <div class="col-lg-12 col-12">
                            <x-form.input type="email" wirevalue="user.email" icon="fa-solid fa-at"
                                error="Este campo es requerido">
                                Email del negocio
                            </x-form.input>
                        </div> --}}

                    </div>

                </x-cardsave>
            </div>

            <div class="col-lg-6 col-12">
                @livewire('components.profile.card-upload', ['user' => $user, 'field' => 'logo'], key('card-upload-logo' . $user->id))
            </div>
        </div>
        
    </x-sectioncontent>



</div>
