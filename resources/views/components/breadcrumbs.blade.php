@props(['title' => '', 'icon' => ''])
<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">


        @if ($icon != '')
            <h1><i class="{{ $icon }} mr-2"></i> {{ $title }}</h1>
        @else
            <h1>{{ $title }}</h1>
        @endif



        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>

    </div><!-- /.container-fluid -->
</section>
