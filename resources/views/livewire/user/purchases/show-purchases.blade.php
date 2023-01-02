<div>

    {{-- Inicio del ShowProducts --}}

    {{-- Because she competes with no one, no one can compete with her. --}}

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
                        <li class="breadcrumb-item active">Compras</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    @livewire('user.product.create-product-modal')
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col">
                    @if ($purchases->count() > 0)

                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered table-hover table-striped">

                                    <thead>
                                        <tr>
                                            <th role="button" wire:click="order('id')" class="text-center"><span>id</span> <i
                                                    class="fas fa-sort"></i>
                                            </th>
                                            <th role="button" wire:click="order('created_at')">Fecha</th>
                                            <th role="button" wire:click="order('updated_at')">Actualizacion</th>
                                            <th class="text-center">Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        @foreach ($purchases as $purchase)

                         
                                            <tr>
                                                <td class="text-center">{{ $purchase->id }} </td>

                                                <td>{{ $purchase->created_at }}</td>
                                                <td>{{ $purchase->updated_at }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('user.products') . '/' . $purchase->id . '/edit' }}"><span style="color: grey; font-size: 25px;"><i class="fa-solid fa-pen-to-square"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- {{ $purchases->links() }} --}}

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    @else
                        No se encontro compras
                    @endif
                </div>

            </div>



        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
