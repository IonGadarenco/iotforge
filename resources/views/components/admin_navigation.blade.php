<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <nav class="flex flex-wrap items-center gap-6 sm:gap-8 justify-between">
            <div class="flex items-center gap-6 sm:gap-8">
                <a href="{{ route('dashboard') }}"
                    class="font-semibold text-xl text-gray-800 leading-tight hover:text-gray-600 transition-colors duration-200">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('device.index') }}"
                    class="font-semibold text-xl text-gray-800 leading-tight hover:text-gray-600 transition-colors duration-200">
                    {{ __('Devices') }}
                </a>
            </div>
            <!-- User Profile Dropdown -->
            <div class="relative">
                <button class="flex items-center focus:outline-none" id="userMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                        class="rounded-full border border-gray-300">
                </button>
                <ul class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg text-sm z-10"
                    aria-labelledby="userMenuButton">

                    <li>
                        <a class="dropdown-item py-2 px-4 text-gray-700 hover:bg-gray-100"
                            href="{{ route('profile.show') }}">Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-1">
                    </li>
                    <li>
                        <a class="dropdown-item py-2 px-4 text-gray-700 hover:bg-gray-100" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
