@auth
    <form action="{{ $route }}" method="POST">
        @csrf
        <textarea name="comment" class="w-full h-48 p-3" placeholder="Enter comment" value={{ old('comment') }}></textarea>

        <button  type="submit" class="bg-blue-400 hover:bg-blue-500 text-white w-full p-2 rounded-lg">Submit</button>
        <x-errors></x-errors>
    </form>
@else
<p class="my-4"><a href="{{ route('login') }}" class="text-blue-400 underline cursro-pointer hover:text-blue-500">Sign in</a> to post comments</p>
@endauth