<div>
    <div class="row">
        <div class="col-lg-12 col">
            <x-form.input type="text" wirevalue="category.name" error="este campo es obligatorio">
                Nueva categoria
            </x-form.input>
        </div>
    </div>
    {{-- test --}}
    <div class="row">
        <div class="col-lg-12 col  mb-3">
            <label for="">Escaja la categoria superior</label>
            <select class="form-control custom-select mb-3 mr-2" wire:model="category.category_id">
                @foreach ($categoriesRecursive as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                    @foreach ($category->childrenCategories as $childCategory)
                        @include('livewire.manage.products.categories.child_category', [
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

    <div class="row">

        <div class="col-lg-6 col-6">

            <x-form.select wirevalue="category.has_color" label="Tiene Color?" error="Debe indicar Si o NO">
                <option value="">Seleccionar</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
            </x-form.select>

        </div>

        <div class="col-lg-6 col-6">

            <x-form.select wirevalue="category.has_size" label="Tiene Talla?" error="Debe indicar Si o NO">
                <option value="">Seleccionar</option>
                <option value="1">SI</option>
                <option value="0">NO</option>
            </x-form.select>

        </div>
    </div>

</div>
