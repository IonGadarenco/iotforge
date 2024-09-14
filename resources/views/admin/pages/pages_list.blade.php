<li class="dd-item" data-id="{{ $page->id }}">
    <div class="dd-handle">
        <div class="row">
            <div class="col-md-9 ">
                {{ $page->name }}
            </div>
            <div class="col-md-3 border-start" style="text-align: end ">

                <a style="padding: 3px;" class="dd-nodrag" href="javascript:void(0)"
                    onclick="DeleteConfirm('{{ route("admin.pages.destroy", $page->id) }}')" title="șterge"><i
                        class="far fa-trash-alt"></i></a>
                <a style="padding: 3px;" class="dd-nodrag" href="{{ route("admin.pages.edit", $page->id) }}" title="editează"><i
                        class="far fa-edit"></i></a>

                @if ($page->first_menu)
                    <a style="padding: 3px;" class="dd-nodrag" href="{{ route("admin.pages.setFirstMenu", [$page->id, 0]) }}"
                        title="Ascunde Menu principal"><i class="fa fa-minus text-danger font-18"></i></a>
                @else
                    <a style="padding: 3px;" class="dd-nodrag" href="{{ route("admin.pages.setFirstMenu", [$page->id, 1]) }}"
                        title="Activează Menu principal"><i class="fa fa-plus text-success font-18"></i></a>
                @endif

                @if ($page->second_menu)
                    <a style="padding: 3px;" class="dd-nodrag" href="{{ route("admin.pages.setSecondMenu", [$page->id, 0]) }}"
                        title="Ascunde Menu secundar"><i class="fa fa-minus text-danger font-18"></i></a>
                @else
                    <a style="padding: 3px;" class="dd-nodrag" href="{{ route("admin.pages.setSecondMenu", [$page->id, 1]) }}"
                        title="Activează Menu secundar"><i class="fa fa-plus text-success font-18"></i></a>
                @endif

            </div>
        </div>
    </div>

    @if (count($page->SubPages))
        <ol class="dd-list">
            @foreach ($page->SubPages as $SubPage)
                @include("admin.pages.pages_list", ["page" => $SubPage])
            @endforeach
        </ol>
    @endif
</li>
