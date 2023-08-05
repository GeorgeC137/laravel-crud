<x-app-layout>
    {{-- <div id="app"></div> --}}
    @auth
        <p class="text-green-700 font-bold">Welcome {{ auth()->user()->full_name }}</p>
        <form action="{{ route('logout.user') }}" class="inline" method="post">
            @csrf
            <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </form>

        @if (session()->has('update'))
            <p class="text-green-700 text-2xl font-semibold">{{ session('update') }}</p>
        @endif

        @if (session()->has('delete'))
            <p class="text-green-700 text-2xl font-semibold">{{ session('delete') }}</p>
        @endif

        <div class="flex min-h-full flex-1 flex-col justify-center mx-auto px-6 py-12 lg:px-8">
            <h2 class="text-orange-600 mb-8 font-bold">Crate A Post</h2>
            @if (session('message'))
                <p class="text-green-600 text-2xl">{{ session('message') }}</p>
            @endif
            <form action="{{ route('create.post') }}" method="post">
                @csrf
                <input type="text" placeholder="Enter post title" name="title" class="mb-4">
                @error('title')
                    <p class="text-red-500 font-semibold">{{ $message }}</p>
                @enderror <br>
                <textarea name="body" placeholder="Enter post description..." class="mb-4"></textarea>
                @error('body')
                    <p class="text-red-500 font-semibold">{{ $message }}</p>
                @enderror <br>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-semibold">Post</button>
            </form>
        </div>

        {{-- See all posts  --}}
        <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <h2 class="text-green-700 font-bold">All posts</h2>
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="bg-gray-500 px-2">
                        <h3 class="mb-2 text-white font-semibold">{{ $post->title }} posted by <a href="{{route('user.posts', $post->user)}}" class="text-blue-400">{{ $post->user->full_name }}</a>
                            <span class="text-purple-300">{{ $post->created_at->diffForHumans() }}</span>
                        </h3>
                        <p class="mb-2 text-white">{{ $post->body }}</p>
                        <a href="/posts/edit/{{ $post->id }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <form action="/posts/delete/{{ $post->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="text-red-700"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>

                        <div class="flex">
                            @if (!$post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="text-green-600 font-semibold mr-2">Like</button>
                                </form>
                            @else
                                <form action="{{route('unlike.post', $post->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-600 font-semibold mr-2">Unlike</button>
                                </form>
                            @endif

                            <span class="text-dark">{{ $post->likes->count() }}
                                {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                <p class="text-red-500 font-bold">There are no posts</p>
            @endif
        </div>
    @endauth

    @guest
        <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Sign Up
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('register.user') }}" method="post">
                    @csrf
                    <div>
                        <label for="full_name"
                            class="block text-sm font-medium @error('full_name')border-red-500 @enderror leading-6 text-gray-900">Full
                            Name</label>
                        <div class="mt-2">
                            <input value="{{ old('full_name') }}" id="full_name" name="full_name" type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6 @error('full_name')
                    border-red-500
                  @enderror" />
                            @error('full_name')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                            address</label>
                        <div class="mt-2">
                            <input value="{{ old('email') }}" id="email" name="email" type="email"
                                autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6" />
                            @error('email')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6" />
                            @error('password')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm
                            Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="current-password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6" />
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-green-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            Sign up
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Already have an account?
                    {{ ' ' }}
                    <a href="/login" class="font-semibold leading-6 text-green-500 hover:text-green-700">Login</a>
                </p>
            </div>
        </div>
    @endguest
</x-app-layout>
