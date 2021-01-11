
<div class="mb-3">
    <label for="title" class="mb-1 block">Title</label>
    <input type="text" name="title" id="title" class="py-2 px-1 w-full bg-white rounded-md text-gray-600" value="{{ old('title', $post->title ?? null) }}">
</div>

<div class="mb-3">
    <label for="content" class="mb-1 block">Content</label>
    <textarea type="text" name="content" id="content" class="py-2 px-1 w-full bg-white rounded-md h-48 text-gray-600">{{ old('content', $post->content ?? null) }}</textarea>
</div>

<div class="mb-3">
    <label for="tags"> Select Tags</label><br>

        @foreach ($tags as $tag)
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @if(isset($post->tags))
            {{ $post->tags->contains($tag) ? 'checked' : '' }}
            @endif> {{ $tag->name }}</input><br>
        @endforeach

</div>

<div class="mb-3"> 
    <label for="thumbnail" class="mb-2 inline-block">Upload a header picture</label>
    <input type="file" name="thumbnail" id="thumbnail" class="w-full">
</div>

<x-errors></x-errors>
<button type="submit" class="w-full bg-gray-300 hover:bg-gray-400 rounded-lg text-white py-2 px-1">Submit</button>