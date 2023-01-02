<section class="content">
    <div class="container-fluid">

        @if ($order->observations_time)
            <div class="alert alert-warning" role="alert">
                <div>
                    <i class="fa-solid fa-clock mr-2"></i> {{ $order->observations_time }}
                </div>
            </div>
        @endif

        @if ($order->observations_public)
            <div class="alert alert-warning" role="alert">
                <div>
                    {{ $order->observations_public }}
                </div>
            </div>
        @endif

    </div>
</section>