
<div class="list-group shadow-lg">

    @foreach ($blogs as $blog)
    <a href="{{ route('single_page', $blog->id) }}" class="list-group-item list-group-item-action text-primary">{{ $blog->title }}</a>
<!-- Additional blog details can be displayed here -->
    @endforeach
</div>