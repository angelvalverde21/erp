<div>
    {{-- Be like water. --}}
    <div class="mb-3">
        <div class="input-group mb-3">
            <input type="hidden" wire:model="address.user_id">
        </div>
    </div>

    <div>

        <hr>
    
        @include('livewire.components.addresses._form-address')
    
    </div>
    

</div>
