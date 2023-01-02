<div>

    {{-- Inicio del ShowProducts --}}

    {{-- Because she competes with no one, no one can compete with her. --}}

    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <a href="{{ route('user.products.create') }}" class="btn btn-success"><i class="fa-solid fa-plus mr-1"></i> Crear Producto</a>
                    {{-- @livewire('user.product.create-product-modal') --}}
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="input-group mb-3">
                    <input class="form-control" placeholder="Buscar" type="text" value="" wire:model="search">
                </div>

            </div>

            <div class="row">

                <div class="col">
                    @if ($products->count() > 0)

                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered table-hover table-striped">

                                    <thead>
                                        <tr>
                                            <th role="button" wire:click="order('id')" class="text-center"><span>id</span> <i
                                                    class="fas fa-sort"></i>
                                            </th>
                                            <th role="button" class="text-center">Imagen
                                            </th>
                                            <th role="button" wire:click="order('title')">Titulo <i
                                                    class="fas fa-sort"></i>
                                            </th>
                                            <th role="button" wire:click="order('price')">Price <i
                                                    class="fas fa-sort"></i>
                                            </th>
                                            <th role="button">Stock</th>
                                            <th role="button" wire:click="order('created_at')">Fecha</th>
                                            <th role="button" wire:click="order('updated_at')">Actualizacion</th>
                                            <th class="text-center">Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($products as $product)
                         
                                            <tr>
                                                <td class="text-center">{{ $product->id }} </td>
                                                <td class="text-center">

                                                    @if ($product->images->count())
                                                    
                                                        <a href="{{ route('user.products.edit',[$product->id]) }}"><img width="50"
                                                            src="{{ Storage::url($product->images->first()->url) }}"
                                                            alt=""></a>
                                                    @else
                                                        <a style="color: rgb(100, 100, 100);" href="{{ route('user.products') . '/' . $product->id . '/edit' }}"><span style="font-size: 50px;"><i class="fa-solid fa-image"></i></span></a>
                                                    @endif

                                                </td>
                                                <td><a style="color: rgb(100, 100, 100);" href="{{ route('user.products') . '/' . $product->id . '/edit' }}">{{ $product->name }} </a><div><small> {{ $product->category->name }} </small></div></td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('user.products') . '/' . $product->id . '/edit' }}"><span style="color: grey; font-size: 25px;"><i class="fa-solid fa-pen-to-square"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- {{ $products->links() }} --}}

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    @else
                        No se encontro resultados
                    @endif
                </div>

            </div>



        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
