@props(['title' => '', 'icon' => ''])
<section class="content-header d-none d-md-block">
    <div class="container-fluid d-flex justify-content-between align-items-center">


        @if ($icon != '')
            <h5><i class="{{ $icon }} mr-2"></i> {{ $title }}</h5>
        @else
            <h5>{{ $title }}</h5>
        @endif



        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>

    </div><!-- /.container-fluid -->
</section>
