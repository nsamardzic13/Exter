 <br>
<div class="container">
    <h2 class="text-center">WALL OF "{{ Str::upper($group->name ?? $occasion->name) }}"</h2>
    <br>
    @include('messages.new_message')
    <br><br>
    <section class="posts endless-pagination" data-next-page="{{ $messages->nextPageUrl() }}">
        @include('messages.index_scroll')
    </section>
</div>


