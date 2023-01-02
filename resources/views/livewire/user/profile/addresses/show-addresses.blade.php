<div>
    {{-- Stop trying to control. --}}

    {{-- {{ $addresses }} --}}


    <div class="card">
        {{-- <div class="card-header">
            <i class="fa-solid fa-truck"></i>
        </div> --}}
        <div class="card-body">

            <div class="accordion" id="accordionExample">

                @foreach ($addresses as $address)

                    <div class="accordion-item" wire:key="address-{{ $loop->index }}">

                        <h2 class="accordion-header" id="headingOne-{{ $address->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne-{{ $address->id }}" aria-expanded="false"
                                aria-controls="collapseOne-{{ $address->id }}">
                                <ul style="margin: 0; padding: 0">
                                    <li class="my-1">{{ $address->name }}</li>
                                    <li class="my-1">{{ $address->primary }}</li>
                                    <li class="my-1">{{ $address->secondary }}</li>
                                    <li class="my-1">{{ $address->references }}</li>
                                    <li class="my-1">{{ $address->phone }}</li>
                                    <li class="my-1">{{ $address->dni }}</li>
                                    <li class="my-1">{{ $address->district->name }} -
                                        {{ $address->district->province->name }} -
                                        {{ $address->district->province->department->name }}</li>
                                </ul>
                            </button>
                        </h2>

                        <div id="collapseOne-{{ $address->id }}" class="accordion-collapse collapse" 
                            aria-labelledby="headingOne-{{ $address->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @livewire('user.profile.addresses.edit-address', ['address' => $address], key('edit-address-accordion-' . $address->id))
                            </div>
                        </div>
                        
                    </div>
                @endforeach

            </div>

        </div>
        <div class="card-footer">
            @livewire('user.profile.addresses.create-address-modal', ['user' => $user], key('create-address-modal-' . $user->id))
        </div>
    </div>


</div>
