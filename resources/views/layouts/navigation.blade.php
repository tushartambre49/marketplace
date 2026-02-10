<nav x-data="{ open: false }"
     class="bg-white border-b border-gray-100">


{{-- ================= PRIMARY NAV ================= --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">

        {{-- ================= LEFT ================= --}}
        <div class="flex">

            {{-- LOGO --}}
            <div class="shrink-0 flex items-center">
                <a href="{{ route('listings.index') }}">
                    <x-application-logo
                        class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            {{-- DESKTOP NAV LINKS --}}
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                {{-- COMMON --}}
                <x-nav-link
                    :href="route('listings.index')"
                    :active="request()->routeIs('listings.*')">
                    Listings
                </x-nav-link>

                @auth

                    {{-- ================= ADMIN ================= --}}
                    @can('isAdmin')

                        <x-nav-link
                            :href="route('admin.listings.moderation')"
                            :active="request()->routeIs('admin.*')">
                            Admin Moderation
                        </x-nav-link>

                    @endcan


                    {{-- ================= PROVIDER ================= --}}
                    @if(auth()->user()->role === 'provider')

                        <x-nav-link
                            :href="route('provider.listings.index')"
                            :active="request()->routeIs('provider.listings.*')">
                            My Listings
                        </x-nav-link>

                        <x-nav-link
                            :href="route('provider.enquiries.index')"
                            :active="request()->routeIs('provider.enquiries.*')">
                            Enquiries
                        </x-nav-link>

                    @endif


                    {{-- ================= CUSTOMER ================= --}}
                    @if(auth()->user()->role === 'customer')

                        <x-nav-link
                            :href="route('customer.enquiries.index')"
                            :active="request()->routeIs('customer.enquiries.*')">
                            My Enquiries
                        </x-nav-link>

                    @endif

                @endauth

            </div>
        </div>

        {{-- ================= RIGHT ================= --}}
        <div class="hidden sm:flex sm:items-center sm:ms-6">

            <x-dropdown align="right" width="48">

                {{-- TRIGGER --}}
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">

                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Login / Register
                        @endauth

                        <svg class="ms-1 h-4 w-4 fill-current"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                        </svg>
                    </button>
                </x-slot>

                {{-- DROPDOWN --}}
                <x-slot name="content">

                    @auth

                        <x-dropdown-link
                            :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST"
                              action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    @else

                        <x-dropdown-link
                            :href="route('login')">
                            Login
                        </x-dropdown-link>

                        <x-dropdown-link
                            :href="route('register')">
                            Register
                        </x-dropdown-link>

                    @endauth

                </x-slot>
            </x-dropdown>
        </div>

        {{-- ================= HAMBURGER ================= --}}
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 hover:bg-gray-100">

                <svg class="h-6 w-6"
                     stroke="currentColor"
                     fill="none"
                     viewBox="0 0 24 24">

                    <path
                        :class="{'hidden': open, 'inline-flex': ! open }"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />

                    <path
                        :class="{'hidden': ! open, 'inline-flex': open }"
                        class="hidden"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>
</div>

{{-- ================= MOBILE MENU ================= --}}
<div :class="{'block': open, 'hidden': ! open}"
     class="hidden sm:hidden border-t">

    <div class="pt-2 pb-3 space-y-1">

        <x-responsive-nav-link
            :href="route('listings.index')">
            Listings
        </x-responsive-nav-link>

        @auth

            {{-- ADMIN --}}
            @can('isAdmin')
                <x-responsive-nav-link
                    :href="route('admin.listings.moderation')">
                    Admin Moderation
                </x-responsive-nav-link>
            @endcan

            {{-- PROVIDER --}}
            @if(auth()->user()->role === 'provider')

                <x-responsive-nav-link
                    :href="route('provider.listings.index')">
                    My Listings
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('provider.enquiries.index')">
                    Enquiries
                </x-responsive-nav-link>

            @endif

            {{-- CUSTOMER --}}
            @if(auth()->user()->role === 'customer')

                <x-responsive-nav-link
                    :href="route('customer.enquiries.index')">
                    My Enquiries
                </x-responsive-nav-link>

            @endif

        @endauth

    </div>

    {{-- MOBILE AUTH --}}
    <div class="pt-4 pb-1 border-t">

        <div class="px-4">

            @auth
                <div class="font-medium">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="block text-blue-600 mb-2">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded">
                    Register
                </a>
            @endguest

        </div>
    </div>
</div>


</nav>
