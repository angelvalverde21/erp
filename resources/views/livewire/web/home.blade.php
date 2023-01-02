<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    {{-- @livewire('web.components.carousel') --}}

    @if ($posts->count() > 0)

        @foreach ($posts as $post)
            @livewire('web.home.show-posts', ['post' => $post], key('post' . $post->id))
        @endforeach

        {{-- <div class="row">
            <div class="col">
                @foreach ($posts as $post)
                    <div class="card mx-auto mt-5 p-3" style="width: 500px">
                        <h3 class="card-text">{{ $post->name }}</h3>
                        <img class="card-img-top" src="{{ Storage::url($post->images->first()->url) }}" alt="">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-6 col-lg-6">
                                    <h3 class="">S/. {{ $post->price }}</h3>
                                </div>
                                <div class="col-6 col-lg-6"><a href="{{ $post->id }}"
                                        class="btn btn-primary float-end">Comprar</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    @else
        No se encontro resultados
    @endif

    @push('script')
        <script>
            Livewire.on('glider', function(id) {
                new Glider(document.querySelector('.glider-' + id), {

                    slidesToShow: 3,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.dots-' + id,
                    arrows: {
                        prev: '.glider-prev-' + id,
                        next: '.glider-next-' + id
                    }
                });
            });
        </script>
    @endpush

</div>
