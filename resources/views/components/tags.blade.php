@foreach ($tags as $tag)
    <a class="bg-green-400 text-white rounded-lg px-3 py-1 my-1 cursor-pointer hover:bg-green-500 inline-block" href="{{ route('posts.tag', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
@endforeach