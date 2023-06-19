<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-breadcrumbs title="Informacion de pagina web" />

    <x-sectioncontent>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#carousel" data-toggle="tab">Carousel Web</a></li>
                        <li class="nav-item"><a class="nav-link" href="#carousel-responsive" data-toggle="tab">Carousel Mobile</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">

                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="carousel">
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
