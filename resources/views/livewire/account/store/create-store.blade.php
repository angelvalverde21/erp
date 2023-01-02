<div>
    {{-- Do your work, then step back. --}}

    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-breadcrumbs title="Crear nueva tienda" />

    <x-sectioncontent>


        <div class="card">
            
            <div class="card-header">Agregar</div>

            <div class="card-body">

                <x-form.input type="text" wirevalue="store.name" icon="fa-solid fa-heading">
                    Titulo de la tienda
                </x-form.input>

                <x-form.input type="text" wirevalue="store.nickname" icon="fa-regular fa-user">
                    Escoja un nickname
                </x-form.input>

                <x-form.input type="text" wirevalue="store.email" icon="fa-solid fa-envelope">
                    Email
                </x-form.input>

                <x-form.input type="number" wirevalue="store.phone" icon="fa-solid fa-phone">
                    telefono
                </x-form.input>

            </div>

            <div class="card-footer">

                <x-form.save />


            </div>
        </div>

    </x-sectioncontent>

</div>
