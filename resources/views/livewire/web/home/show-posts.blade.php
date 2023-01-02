<div wire:init="loadPosts">
    {{-- Be like water. --}}

    <div class="posts my-5">

        @if ($show)

            <div class="glider-contain">

                <div role="tablist" class="mb-3 dots dots-{{ $post->id }}"></div>

                <div class="glider glider-{{ $post->id }}">


                    @foreach ($post->images as $image)


                        <figure><img class="" src="{{ Storage::url($image->url) }}" alt=""></figure>
                    @endforeach

                </div>

                <button aria-label="Previous" class="glider-prev glider-prev-{{ $post->id }}">«</button>
                <button aria-label="Next" class="glider-next glider-next-{{ $post->id }}">»</button>


            </div>
        @else
            <div class="spinner d-flex align-items-center justify-content-center" style="height: 150px">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

        @endif

    </div>



</div>
