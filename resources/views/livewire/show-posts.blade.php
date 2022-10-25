<div>
    Show Posts

    <p>{{ $message }}</p>

    @foreach ($posts as $post)
        {{ $post->user->name }} - {{ $post->content }} <br>
    @endforeach
</div>
