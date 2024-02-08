<nav class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
    <div id="nav-left" class="flex items-center">
        <a href="{{ route('home') }}">
            <x-application-logo />
        </a>
        <div class="ml-10 top-menu">
            <div class="flex space-x-4">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                    {{ __('Blog') }}
                </x-nav-link>
                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-nav-link>
                <x-nav-link href="{{ route('contacts.index') }}" :active="request()->routeIs('contacts.index')">
                    {{ __('Contact') }}
                </x-nav-link>
            </div>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">
        @auth
        @include('layouts.partials.header-right-auth')
        @else
        @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>