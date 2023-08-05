<x-app-layout>
<div class="flex min-h-full flex-1 flex-col justify-center mx-auto px-6 py-12 lg:px-8">
    <h2 class="text-orange-600 mb-8 font-bold">Edit Post</h2>
    <form action="/posts/edit/{{$post->id}}" method="post">
        @csrf
        @method('put')
        <input type="text" name="title" class="mb-4" value="{{$post->title}}">
        @error('title')
            <p class="text-red-500 font-semibold">{{$message}}</p>
        @enderror <br>
        <textarea name="body" class="mb-4">{{$post->body}}</textarea>
        @error('body')
            <p class="text-red-500 font-semibold">{{$message}}</p>
        @enderror <br>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-semibold">Edit</button>
    </form>
</div>
</x-app-layout>