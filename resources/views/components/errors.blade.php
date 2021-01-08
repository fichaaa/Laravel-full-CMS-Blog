@if($errors->any())
   <div class="mb-3">
    @foreach ($errors->all() as $error)
        <div class="w-full my-1 py-1 px-3 bg-red-300 rounded-lg">{{ $error }}</div>
    @endforeach
    </div>

@endif