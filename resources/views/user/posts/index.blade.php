<x-app-layout>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <a href="/" class="mb-2 font-semibold">Back</a>
        <h2 class="text-green-700 font-bold">{{$user->full_name}}</h2>
        <p class="mb-2">Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}} and received {{$user->receivedLikes->count()}} {{Str::plural('likes', $user->receivedLikes->count())}}</p>
        <div class="bg-gray-500 px-2">
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
                <p class="text-white font-bold">{{$user->full_name}} does not have any posts</p>
            @endif
        </div>
    </div>
</x-app-layout>
