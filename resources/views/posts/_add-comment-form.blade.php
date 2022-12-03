@auth()
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments" >
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="user avatar" class="rounded-full">
                <h2 class="ml-5">Want to participate?</h2>
            </header>
            <div class="mt-5">
                            <textarea class="w-full text-small rounded-xl p-3 focus:outline-none focus:ring"
                                      name="body" cols="10" rows="5"
                                      placeholder="Say something!"
                                      required
                            ></textarea>
                @error('body')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                <x-submit-button>post</x-submit-button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline text-blue-500">Register </a>or <a href="/login" class="hover:underline text-blue-500">Log in </a>to leave a comment.
    </p>

@endauth
