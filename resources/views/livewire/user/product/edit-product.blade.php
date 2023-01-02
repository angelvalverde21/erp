<div>
    {{-- The whole world belongs to you. --}}
    {{-- {{$product->id}} --}}



    @livewire('user.product.components.inputs', ['product' => $product], key('product-inputs-'.$product->id))


    <section class="content">

        <div class="container-fluid">
            {{-- inicio de tabs --}}

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Fotos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Colores y tallas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Sesiones</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active bg-white p-3" id="home" role="tabpanel"
                    aria-labelledby="home-tab">

                    {{-- call out --}}

                    {{-- <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <h4>Foto principal</h4>
                                
                            </div>
                        </div>

                    </div> --}}

                    <div class="accordion mt-3" id="accordionFlushExample">

                        @livewire('user.product.components.images', ['product' => $product], key('product-images-' . $product->id)) 

                    </div>
                </div>
                
                <div class="tab-pane fade bg-white p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    @livewire('user.product.components.colors', ['product' => $product], key('product-colors-' . $product->id))

                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Sesiones</div>
            </div>
        </div>

    </section>




</div>
