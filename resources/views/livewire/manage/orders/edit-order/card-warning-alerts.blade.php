<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <style>
        .alert-success {
            background-color: #D4EDDA;
            border-color: #C3E6CB;
            color: #2D2D2D;
        }

        .alert-warning {
            background-color: #FFF3CD;
            border-color: #FFECB5;
            color: #2D2D2D;
        }

        .alert-danger {
            background-color: #F8D7DA;
            border-color: #F5C6CB;
            color: #2D2D2D;
        }
    </style>

    <x-sectioncontent>

        @if ($order->MessagenCalendar)
            <x-alert alert="success" icon="fa-solid fa-truck">
                Entregar: {{ $order->MessagenCalendar }}
            </x-alert>
        @endif

        @if ($order->observations_time)
            <x-alert alert="success" icon="fa-solid fa-clock">
                DELIVERY: {{ $order->observations_time }}
            </x-alert>
        @endif

        @if ($order->observations_public)
            <x-alert alert="warning">
                (Informacion Publica) {{ $order->observations_public }}
            </x-alert>
        @endif


        @if ($order->observations_private)
            <x-alert alert="danger">
                (PRIVADO) {{ $order->observations_private }}
            </x-alert>
        @endif

    </x-sectioncontent>
</div>
