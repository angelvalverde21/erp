<x-form.select label="Se le cobrara..." wirevalue="order.collect_method_id" icon="fa-solid fa-cash-register" wirechange="saveSelected()">

    @foreach (collectMethods() as $colectMethod)
        <option value="{{ $colectMethod->id }}">
            {{ $colectMethod->title }}</option>
    @endforeach

</x-form.select>
