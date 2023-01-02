<div>

    <x-sectioncontent>

        <x-cardsave title="Mi Perfil" titlesmall="Estos datos no seran publicos">

            <div class="row">

                <div class="col-lg-12 col-12">

                    <div class="mb-3">
                        <x-form.input type="text" wirevalue="user.name"
                            icon="fa-solid fa-user" error="Este campo es requerido">
                            Nombre completo
                        </x-form.input>
                    </div>
                </div>


                <div class="col-lg-6 col-12">
                    <x-form.input type="number" wirevalue="user.dni"
                        icon="fa-solid fa-id-badge" error="Este campo es requerido">
                        DNI
                    </x-form.input>
                </div>


                <div class="col-lg-6 col-12">
                    <x-form.input type="number" wirevalue="user.phone"
                        icon="fa-solid fa-mobile" error="Este campo es requerido">
                        Celular
                    </x-form.input>
                </div>


            </div>

            <div class="row">

                <div class="col-lg-6 col-12">
                    <x-form.input type="email" wirevalue="user.email" icon="fa-solid fa-at"
                        error="Este campo es requerido">
                        Email
                    </x-form.input>
                </div>

                <div class="col-lg-6 col-12">
                    <x-form.input type="date" wirevalue="user.birthday"
                        icon="fa-solid fa-cake-candles" error="Este campo es requerido">
                        Fecha de Nacimiento
                    </x-form.input>
                </div>

            </div>

        </x-cardsave>

    </x-sectioncontent>

</div>
