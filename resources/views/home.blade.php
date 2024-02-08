<x-app-layout title="Home Page">

    @section('hero')
    <div class="w-full py-32 text-center">
        <h1 class="text-2xl font-bold text-center text-gray-700 md:text-3xl lg:text-5xl">
            Welcome to
        </h1>
        <x-application-logo />
        <!--
            Random Slider
        -->
    </div>
    @endsection

    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500"> {{ __('Featured Posts') }} </h2>
            <div class="w-full">
                <div class="grid w-full grid-cols-3 gap-10">
                    @foreach ($featuredPosts as $post)
                    <x-posts.post-card :post="$post" class="col-span-3 md:col-span-1" />
                    @endforeach
                </div>
            </div>
            <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('posts.index') }}">
                {{ __('More Posts') }}</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500">{{ __('Latest Posts') }}</h2>
        <div class="w-full mb-5">
            <div class="grid w-full grid-cols-3 gap-10">
                @foreach ($latestPosts as $post)
                <x-posts.post-card :post="$post" class="col-span-3 md:col-span-1" />
                @endforeach
            </div>
        </div>
        <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('posts.index') }}">
            {{ __('More Posts') }}</a>
    </div>
</x-app-layout>