@forelse ($comments as $comment)
    <div class="mb-3">
        <p >{{ $comment->content }}</p>
        <x-tags :tags="$comment->tags"></x-tags>
        <x-update :item="$comment" :name="$comment->user->name"></x-update>
    </div>
@empty
    <p>No comments yet!</p>
@endforelse