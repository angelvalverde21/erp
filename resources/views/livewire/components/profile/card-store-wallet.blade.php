<div>
    {{-- Be like water. --}}
    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6 col-12">

                <x-cardsave title="YAPE">

                    <x-form.input type="text" wirevalue="user.wallet.yape" texticon="#Yape" icon="fa-solid fa-link"
                        error="">
                        Numero Yape
                    </x-form.input>

                    <x-form.input type="text" wirevalue="user.wallet.titular_yape" icon="fa-solid fa-user"
                    error="">
                        Titular
                    </x-form.input>

                    <div class="col">
                        @livewire('components.profile.card-upload', ['user' => $user, 'field' => 'qr_yape'], key('card-upload-yape-' . $user->id))
                    </div>

                    <x-form.input type="text" wirevalue="user.wallet.code_yape" texticon="Code" icon="fa-solid fa-link"
                        error="">
                        Codigo Qr
                    </x-form.input>

                </x-cardsave>

        </div>

            <div class="col-lg-6 col-12">

                <x-cardsave title="PLIN">

                    <x-form.input type="text" wirevalue="user.wallet.plin" texticon="# Plin" icon="fa-solid fa-link"
                        error="este usuario esta ocupado">
                        Codigo Plin
                    </x-form.input>

                    <x-form.input type="text" wirevalue="user.wallet.titular_plin" icon="fa-solid fa-user"
                    error="">
                        Titular
                    </x-form.input>


                    <div class="col">
                        @livewire('components.profile.card-upload', ['user' => $user, 'field' => 'qr_plin'], key('card-upload-plin-' . $user->id))

                    </div>

                    <x-form.input type="text" wirevalue="user.wallet.code_plin" texticon="Code"
                        icon="fa-solid fa-link" error="este usuario esta ocupado">
                        Codigo Qr
                    </x-form.input>

                </x-cardsave>
            </div>
        </div>



    </x-sectioncontent>
</div>
