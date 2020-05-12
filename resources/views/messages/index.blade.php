<div class="container mt-2">
    <div class="card">
        <div class="card-header header-wall">
            <h3><b>Group Wall</b> <small>of "{{ Str::upper($group->name ?? $occasion->name) }}"</small></h3>
            <button type="button" class="btn btn-outline-quest rounded-pill zoom float-right" data-toggle="modal" data-target="#myModal_newmessage"> Post <i class="fas fa-plus"></i>
            </button>

        </div>
        <div class="card-body">
        <section class="posts endless-pagination" data-next-page="{{ $messages->nextPageUrl() }}">
            @include('messages.index_scroll')
        </section>
        </div>
    </div>
</div>


