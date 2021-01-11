<form action="{{ $route }}" method="POST">
    @csrf
    <textarea name="comment" class="w-full h-48 p-3" placeholder="Enter comment" value={{ old('comment') }}></textarea>

    <button  type="submit" class="bg-blue-400 hover:bg-blue-500 text-white w-full p-2 rounded-lg">Submit</button>
    <x-errors></x-errors>
</form>