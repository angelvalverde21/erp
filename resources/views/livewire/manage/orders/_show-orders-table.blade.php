<div class="table-responsive">
    {{-- <h4 class="card-title">Productos</h4>
    <h6 class="card-subtitle">Productos actualmente en almacen</h6> --}}

    {{-- {{ count($orders) }}
        <hr>
        {{ count($orders2) }}
        <hr> --}}


    {{-- @foreach ($orders2 as $order)
            {{ $order->id }}
        @endforeach --}}

    @if (count($orders) > 0)

    <table id="example1" class="table table-striped">

        <thead>
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Status</th>
                <th>Asignado</th>
                <th class="text-center">Status</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Autor</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Editar</th>
            </tr>
        </thead>
        {{-- <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Entregar por</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Editar</th>
                </tr>
            </tfoot> --}}
        <tbody>
    
            @foreach ($orders as $order)
                {{-- {{ $order }} --}}
                {{-- Ojo is_active es un campo de la base de datos, pero is_pay es una instancia --}}
                <tr @if (!$order->is_active) class="bg-danger" @endif
                    @if ($order->is_delivered()) style="background: #E2FBDF;" @endif>
    
    
                    @if ($order->is_pay())
                        <td class="text-center" style="background: #E2FBDF;">
                            <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            <p class="mt-1">#{{ $order->id }}</p>
    
                        </td>
                    @else
                        <td class="text-center">
                            <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <p class="mt-1">#{{ $order->id }}</p>
    
                        </td>
                    @endif
    
                    <td class="">
                        <h6>{{ strtoupper($order->buyer->name) }}</h6>
                        {{-- {{ $order->address }} --}}
    
                        <li>DNI: {{ $order->address->dni }}</li>
                        <li>{{ $order->address->primary }}</li>
                        <li>{{ $order->address->secondary }}</li>
                        <li>References: </li>
                        <li>{{ $order->address->references }}</li>
                        <li><strong>{{ $order->address->district->name }}</strong> -
                            {{ $order->address->district->province->name }} -
                            {{ $order->address->district->province->department->name }}</li>
                        <li>{{ $order->delivery_time_start }} Hasta {{ $order->delivery_time_end }}
                        </li>
                        <li>{{ $order->address->phone }}</li>
    
                        <li class="d-flex flex-row">
                            <a class="btn btn-secondary d-flex align-items-center" style="font-size: 10pt;"
                                href="tel:+51{{ $order->address->phone }}">
                                <i class="fa-solid fa-square-phone"></i>
                                <span class="mx-1">{{ $order->address->phone }}</span>
                            </a>
                            <a class="btn btn-success mx-2" style="font-size: 10pt;" target="_blank"
                                href="https://api.whatsapp.com/send?phone=51{{ $order->address->phone }}&text={{ urlencode('Hola buen dia, Somos ' . Str::upper($store->nickname) . ' Express Courier, te informamos que tu pedido sera entregado hoy, en el horario cordinado, tu codigo de pedido es: #') }}{{ $order->id }}">Whatsp</a>
    
                            <a class="btn btn-primary" style="font-size: 10pt;" target="_blank"
                                href="https://www.google.com/maps/search/{{ $order->address->primary }},{{ $order->address->district->province->name }}"><i
                                    class="fa-solid fa-diamond-turn-right"></i><span
                                    class="mx-1">Ruta</span></a>
                        </li>
    
                    </td>
    
                    <td class="text-center">
                        @if ($order->is_pay())
                            <span class="text-success" style="font-size: 1.5rem"><i
                                    class="fa-solid fa-sack-dollar"></i></span>
                        @else
                            <span class="text-secondary" style="font-size: 1.5rem"><i
                                    class="fa-solid fa-sack-dollar"></i></span>
                        @endif
                    </td>
    
                    <td>
                        {{-- Imanges de los productos --}}
    
                        @foreach ($order->items as $item)
                            @if (isset($item->content->image))
                                <a href="{{ Storage::url($item->content->image) }}"
                                    data-lightbox="show-images-preview-{{ $order->id }}"
                                    data-title="TALLA: {{ $item->content->talla_impresa }}">
                                    <img style="height: 125px"
                                        src="{{ Storage::url($item->content->image) }}" alt="">
                                    ({{ $item->content->talla_impresa }})
                                </a>
                            @else
                                Sin imagen
                            @endif
                        @endforeach
                    </td>
    
                    <td class="text-center">
                        {{ $order->delivery_man->name }}
                    </td>
                    <td class="text-center">
    
                        <p>{{ $order->print_status() }}</p>
                        {{-- @if ($order->is_pay())
                                <button class="btn btn-success">Pagado</button>
                            @endif --}}
                        {{-- @foreach ($order->status as $status)
                                {{ $status->title }}
                                @php
                                    break;
                                @endphp
                            @endforeach --}}
    
                    </td>
    
                    <td>{{ $order->total_amount }}</td>
    
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->seller->name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->updated_at }}</td>
                    <td>
                        <a href="#" wire:click="cancelOrder( {{ $order }} )"
                            class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
    
    
        </tbody>
    </table>

    @else
        No hay registros disponibles
    @endif
</div>