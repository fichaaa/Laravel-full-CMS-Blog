<p class="italic text-sm">{{ $item->created_at->diffForHumans() }} 
@if(isset($item->user))
   by {{ $item->user->name }}
@endif
</p>