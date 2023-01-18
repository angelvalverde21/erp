<div>

    <div class="row mt-3">

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="info-box">
                @if ($order->is_preparing())
                <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-cart-flatbed"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PREPARANDO </span>
                    <span class="info-box-number">
                        ENVIO
                    </span>
                </div>
                @else
                <span class="info-box-icon bg-secondary elevation-1"><i class="fa-solid fa-cart-flatbed"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PREPARANDO </span>
                    <span class="info-box-number">
                        ENVIO
                    </span>
                </div>
                @endif
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="info-box mb-3">
                @if ($order->is_ready_delivery())
                    <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-dolly"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">LISTO PARA</span>
                        <span class="info-box-number">ENVIO</span>
                    </div>
                @else
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fa-solid fa-dolly"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">LISTO PARA</span>
                        <span class="info-box-number">ENVIO</span>
                    </div>
                @endif
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="info-box">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fa-solid fa-truck-fast"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">EN</span>
                    <span class="info-box-number">
                        TRANSITO
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="info-box mb-3">

                @if ($order->is_delivered())
                <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-paper-plane"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ENTREGADO</span>
                    <span class="info-box-number">16-01-2022</span>
                </div>   
                @else
                <span class="info-box-icon bg-secondary elevation-1"><i class="fa-solid fa-paper-plane"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PENDIENTE</span>
                    <span class="info-box-number">ENTREGA</span>

                </div>                    
                @endif


                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        {{-- Because she competes with no one, no one can compete with her. --}}
    </div>
</div>
