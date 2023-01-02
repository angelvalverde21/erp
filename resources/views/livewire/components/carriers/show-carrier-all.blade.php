{{-- user.sales.edit-sale.carrier.show-carrier-all --}}
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="card">

        <div class="card-header">
            <a class="btn btn-success btn-add-empresa float-right" data-toggle="collapse" href="#collapse-create-carrier" role="button"
                aria-expanded="false" aria-controls="collapse-create-carrier">
                Agregar courier
            </a>
        </div>

        <div class="collapse" id="collapse-create-carrier">
            <div class="card-body">
                @livewire('components.carriers.create-carrier', ['user_id' => ''], key('create-carrier'))
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionShowCarrier">

        @foreach ($carriers as $carrier)
            <x-accordion-item id="item-carrier-{{ $carrier->id }}" label="{{ $carrier->name }}"
                accordion_parent_id="accordionShowCarrier">

                <div class="row">
                    <div class="col">
                        <table class="table mt-3">

                            @foreach ($carrier->addresses as $office)
                                <tr>
                                    <td><a href="#"><a class="" href="#" role="button" wire:click.prevent="selectAddress('{{ $office->id }}')">Seleccionar</a></a></td>
                                    <td><strong>{{ $office->title }}</strong></td>
                                    <td>{{ $office->name }}</td>
                                    <td>{{ $office->primary }} {{ $office->secondary }}</td>
                                    <td>{{ $office->references }}</td>
                                    <td>{{ $office->district->name }}</td>
                                    <td>
                                        <a href="#collapse-edit-carrier-{{ $office->id }}" data-toggle="collapse" role="button" aria-expanded="false"
                                            aria-controls="collapseExample"><i class="fa-solid fa-circle-plus mr-2"></i>
                                            Editar
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7">
                                        <div class="collapse mt-4" id="collapse-edit-carrier-{{ $office->id }}">
                                            @livewire('components.carriers.edit-office-carrier', ['address' => $office->id], key('edit-office-carrier-' . $office->id))
                                        </div>

                                    </td>
                                          
                                </tr>


                            @endforeach

                        </table>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary float-right btn-agregar-office" data-toggle="collapse"
                            href="#collapse-carrier-{{ $carrier->id }}" role="button" aria-expanded="false"
                            aria-controls="collapseExample"><i class="fa-solid fa-circle-plus mr-2"></i>
                            Agregar Oficina
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="collapse mt-4" id="collapse-carrier-{{ $carrier->id }}">
                            @livewire('components.carriers.create-office-carrier', ['user_id' => $carrier->id], key('create-office-carrier-' . $carrier->id))
                        </div>
                    </div>
                </div>
                {{-- <script>
                    var myCollapsible = document.getElementById('collapse-carrier-{{ $carrier->id }}');
                    
                    myCollapsible.addEventListener('hide.bs.collapse', function() {
                        console.log('se cerro el collapse');
                    })
                    myCollapsible.addEventListener('show.bs.collapse', function() {
                        console.log('se abrio el collapse');
                    })
                </script> --}}

            </x-accordion-item>
        @endforeach

    </div>

    @push('script')

        <script>
            
            $(document).ready(function() {

                function changeTextBtn(selector,textInit,BtnClass){

                    $(selector).on('click', function() {
                        text = $(this).text().trimStart().trimEnd();

                        if (text == textInit) {
                            console.log(textInit);

                            $(this).text('x');
                            $(this).removeClass(BtnClass);
                            $(this).addClass('btn-secondary');
                        } else {
                            console.log('x');

                            $(this).text(textInit);
                            $(this).removeClass('btn-secondary');
                            $(this).addClass(BtnClass);
                        }

                    });

                }

                changeTextBtn('.btn-agregar-office','Agregar Oficina','btn-primary');
                changeTextBtn('.btn-add-empresa','Agregar courier','btn-success');

            });

        </script>
    @endpush

</div>