@if($show)
    <div class="inline-block {{ $type ?? 'bg-red-500' }} rounded-md py-1 px-3 text-white mb-3">{{ $slot }}</div>
@endif