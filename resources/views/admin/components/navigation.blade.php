@foreach ($departments as $department)
    <li
        class="nav-main-item {{ \Illuminate\Support\Facades\Route::currentRouteName() == $department['id'] ? 'active' : '' }}
        @if (\Illuminate\Support\Str::contains(request()->url(), $department['id'])) @if (count($department['sub_departments']) > 1) open @else active @endif
        @endif">
        <a
            @if (count($department['sub_departments']) == 1) class="nav-main-link"
               href="{{ $department['sub_departments'][0]['route'] }}"
           @else
               class="nav-main-link nav-main-link-submenu"
               data-toggle="submenu" aria-haspopup="true" aria-expanded="false" @endif>
            <i class="nav-main-link-icon {{ $department['icon'] }}"></i>
            <span class="nav-main-link-name">{{ $department['name'] }}</span>
        </a>
        @if (count($department['sub_departments']) > 1)
            <ul class="nav-main-submenu">
                @foreach ($department['sub_departments'] as $sub_department)
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ \Illuminate\Support\Str::contains(request()->url(), $sub_department['id']) || request('status') == $sub_department['id'] ? 'active' : '' }}"
                            href="{{ $sub_department['route'] }}">{{ $sub_department['name'] }}</a>
                    </li>
                @endforeach
            </ul><!--end /submenu -->
        @endif
    </li>
@endforeach
