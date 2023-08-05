<x-mail::message>
# Your post was liked

{{ $liker->full_name }} liked one of your posts.

<x-mail::button :url="'/'">
View Post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
