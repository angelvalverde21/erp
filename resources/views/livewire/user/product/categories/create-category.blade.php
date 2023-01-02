<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row hidden">
        <div class="col-lg-12 col">
            <x-user.input type="text" wirevalue="category.name" error="este campo es obligatorio">
                Nueva categoria
            </x-user.input>
        </div>
    </div>
    <div class="row hidden">
        <div class="col-lg-12 col  mb-3">
            <label for="">Escaja la categoria superior</label>
            <select class="form-select mr-2" wire:model="category.category_id">
                @foreach ($categoriesRecursive as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                    @foreach ($category->childrenCategories as $childCategory)
                        @include('livewire.user.product.categories.child_category', [
                            'child_category' => $childCategory,
                            'separador' => '--',
                        ])
                    @endforeach
                @endforeach
            </select>
            @error('category.category_id')
            <span class="error">Debe seleccionar una categoria superior</span>
        @enderror
        </div>
    </div>

    <div class="row hidden">

        <div class="col-lg-6 col-6">

            <x-user.select wirevalue="category.has_color" texticon="¿Color?" error="Debe indicar Si o NO">
                <option value="">Seleccionar</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
            </x-user.select>
            
        </div>

        <div class="col-lg-6 col-6">

            <x-user.select wirevalue="category.has_size" texticon="¿Talla?" error="Debe indicar Si o NO">
                <option value="">Seleccionar</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
            </x-user.select>

        </div>
    </div>

    <div class="row hidden">
        <div class="col-lg-12 col">
            <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="save"
            class="btn btn-primary ml-auto">Guardar</button>
        </div>
    </div>

    
</div>
