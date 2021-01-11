<p class="italic text-sm">{{ $item->created_at->diffForHumans() }} 
@if(isset($item->user))
   by <a class="underline text-blue-400 hover:text-blue:500" href="{{ route('users.show', ['user' => $item->user->id]) }}">{{ $item->user->name }}
      </a>
@endif
</p>