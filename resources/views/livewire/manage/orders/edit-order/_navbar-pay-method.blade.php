<x-form.select wirevalue="order.payment_list_method_id" icon="fa-solid fa-receipt" wirechange="saveSelected()">

    @foreach (paymentListMethods() as $paymentListMethod)

        {{-- <option value="{{ $paymentMethod->id }}">
            {{ $paymentMethod->title }}</option> --}}
        
        <option value="{{ $paymentListMethod->id }}">
            {{ $paymentListMethod->paymentMethod->title }} - {{ $paymentListMethod->paymentList->title }}</option>


    @endforeach

</x-form.select>


