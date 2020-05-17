<div class="container mt-2">
    <div class="card">
        <div class="card-header header-wall">
            @if(isset($group))
                <h3><b>Group Wall</b> <small>of "{{ Str::upper($group->name) }}"</small></h3>
            @endif
            @if(isset($occasion))
                <h3><b>Event Wall</b> <small>of "{{ Str::upper($occasion->name) }}"</small></h3>
            @endif
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


