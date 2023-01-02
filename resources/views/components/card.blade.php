@props(['title','titlesmall'=>""])
<div class="card mt-3">

    <div class="card-header">
        <div>{{ $title }} </div><small>{{ $titlesmall }}</small>
    </div>

    <div class="card-body">

        {{ $slot }}

    </div>

</div>
