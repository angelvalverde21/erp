<div>

    <div class="row">

        <div class="col-lg-12 col-12">

            {{-- <input type="date" wire:model="order.delivery_date" placeholder="Fecha de entrega" class="form-control"> --}}
            <x-form.input type="date" wirevalue="order.delivery_date"
                error="Este campo es requerido">
                
            </x-form.input>

        </div>

        <div class="col-lg-6 col-12">

            <x-form.select wirevalue="order.delivery_time_start" icon="fa-solid fa-clock">
                <option value="0">Seleccionar</option>
                <option value="8:00:00">8:00 AM</option>
                <option value="9:00:00">9:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="11:00:00">11:00 AM</option>
                <option value="12:00:00">12:00 M</option>
                <option value="13:00:00">1:00 PM</option>
                <option value="14:00:00">2:00 PM</option>
                <option value="15:00:00">3:00 PM</option>
                <option value="16:00:00">4:00 PM</option>
                <option value="17:00:00">5:00 PM</option>
                <option value="18:00:00">6:00 PM</option>
                <option value="19:00:00">7:00 PM</option>
                <option value="20:00:00">8:00 PM</option>
                <option value="21:00:00">9:00 PM</option>
                <option value="22:00:00">10:00 PM</option>
            </x-form.select>

        </div>

        <div class="col-lg-6 col-12">

            <x-form.select wirevalue="order.delivery_time_end" icon="fa-solid fa-clock">
                <option value="0">Seleccionar</option>
                <option value="8:00:00">8:00 AM</option>
                <option value="9:00:00">9:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="11:00:00">11:00 AM</option>
                <option value="12:00:00">12:00 M</option>
                <option value="13:00:00">1:00 PM</option>
                <option value="14:00:00">2:00 PM</option>
                <option value="15:00:00">3:00 PM</option>
                <option value="16:00:00">4:00 PM</option>
                <option value="17:00:00">5:00 PM</option>
                <option value="18:00:00">6:00 PM</option>
                <option value="19:00:00">7:00 PM</option>
                <option value="20:00:00">8:00 PM</option>
                <option value="21:00:00">9:00 PM</option>
                <option value="22:00:00">10:00 PM</option>
            </x-form.select>

        </div>

        <div class="col-lg-12 col-12">
            <x-form.textarea wirevalue="order.observations_time" id="observations_time">
                Observaciones de horario
            </x-form.textarea>
        </div>

        {{-- <div class="col col-lg-12">
            <x-form.select wirevalue="order.delivery_man_id" icon="fa-solid fa-person-biking">
                @foreach ($repartidores as $repartidor)
                    <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
                    </option>
                @endforeach
            </x-form.select>
        </div> --}}

        {{-- <div class="col-lg-12 col">
            <x-form.select wirevalue="order.delivery_method_id" icon="fa-solid fa-truck">
                @foreach ($delivery_methods as $delivery_method)
                    <option value="{{ $delivery_method->id }}">
                        {{ $delivery_method->name }}</option>
                @endforeach
            </x-form.select>
        </div> --}}

        
        {{-- <div class="col-lg-6 col">

            <x-form.input-number wirevalue="order.shipping_cost_carrier" label="Costo de envio real" texticon="S/."
            error="Este campo es requerido">
            0.00
        </x-form.input-number>

        </div>
        <div class="col-lg-6 col">

            <x-form.input-number wirevalue="order.shipping_cost_buyer" label="Costo cobrado al cliente" texticon="S/."
            error="Este campo es requerido">
            0.00
        </x-form.input-number>

        </div> --}}

    </div>

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click.prevent="saveOrder()" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>
        Guardar</button>

    <div class="spinner-border" wire:loading.inline-flex wire:target="saveOrder" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>
