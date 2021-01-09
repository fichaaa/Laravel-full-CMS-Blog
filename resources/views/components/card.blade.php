<div class="bg-white w-full mb-2 rounded-md shadow-sm">
    <h1 class=" p-3">{{ $title }}</h1>
    <p class="italic  p-3">{{ $subtitle }}</p>
    <hr>
    <ul>
        @forelse ($items as $item)
        <li class="p-2"><a class="text-blue-300 hover:text-blue-400 hover:underline italic" href="
            @if($item->title)
            {{ route('posts.show',['post' => $item->id]) }}
            @else
            #
            @endif
            ">{{ $item->title ?? $item->name}}
        </a></li>
        <hr>
        @empty
        <li class="p-2">Not found</li>
        @endforelse
    </ul>
</div>