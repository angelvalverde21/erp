<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-breadcrumbs title="Informacion de pagina web" />

    <x-sectioncontent>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contacto" data-toggle="tab">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" href="#carousel" data-toggle="tab">Carousel Web</a></li>
                        <li class="nav-item"><a class="nav-link" href="#carousel-responsive" data-toggle="tab">Carousel Mobile</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">

                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal">

                                <x-form.input type="text" label="Dominio de la pagina web"  wirevalue="profile.domain" icon="fa-solid fa-link" error="Este campo es requerido">
                                    Dominio
                                </x-form.input>


                                <x-form.input type="text" label="Titulo de la pagina web" wirevalue="profile.title"
                                    error="Este campo es requerido">
                                    Titulo de la pagina web
                                </x-form.input>

                                <x-form.input type="number" label="Monto minimo para envio Gratis" texticon="S/. "
                                    wirevalue="profile.ship_min" error="Este campo es requerido">
                                    0.00
                                </x-form.input>

                                <x-form.input type="number" label="Numero whatsapp publico"  wirevalue="profile.whatsapp" icon="fa-brands fa-whatsapp">
                                    whatsapp
                                </x-form.input>
                                
                                <x-form.input type="text" label="Usuario de facebook"  wirevalue="profile.facebook" icon="fa-brands fa-facebook">
                                    Facebook
                                </x-form.input>

                                <x-form.input type="text" label="Usuario de instagram"  wirevalue="profile.instagram" icon="fa-brands fa-instagram">
                                    Instagram
                                </x-form.input>
                                

                                <x-form.input type="text" label="Usuario de tiktok"  wirevalue="profile.tiktok" icon="fa-brands fa-tiktok">
                                    Tiktok
                                </x-form.input>
                                


                                {{-- <x-form.input type="number" label="Central telefonica" icon="fa-solid fa-phone" wirevalue="profile.phone"
                                    error="Este campo es requerido">
                                    Central Telefonica
                                </x-form.input> --}}

                                {{-- 

                                @if ($store->profile->address_id)
                                    @livewire('components.addresses.show-address-all', ['user' => $store->id, 'model_refer' => 'ProfileWeb', 'model_refer_id' => $store->profile->id], key('show-addresses-store-' . $store->id))
                                @else
                                    @livewire('components.addresses.create-address', ['user_id' => $store->id], key('create-addresses-' . $store->id))
                                @endif 
                               
                                --}}

                                <x-form.save />
                                

                            </form>
                        </div>

                        <div class="tab-pane" id="contacto">
                            <!-- Post -->
                            @livewire('components.addresses.show-address-all', ['user' => $store->id, 'model_refer' => 'User', 'model_refer_id' => $store->id], key('show-addresses-store-' . $store->id))
                            
                        </div>
                        
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="carousel">
                            <!-- The timeline -->
                            @livewire('components.profile.card-carousel-home', ['store' => $store] , key('card-carousel-home'))
                            
                        </div>
                        <!-- /.tab-pane -->
                        
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="carousel-responsive">
                            <!-- The timeline -->
                            @livewire('components.profile.card-carousel-responsive', ['store' => $store] , key('card-carousel-responsive-home'))
                            
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->


            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </x-sectioncontent>
</div>
