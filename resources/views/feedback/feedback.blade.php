<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Leave Your Feedback!</h1>
                <form method="POST" action="/feedback" class="mt-10">
                    @csrf
                    @auth()
                        <div style="display: none">
                            <x-form.input  name="name" value="{{auth()->user()->name}}"/>
                            <x-form.input name="email" type="email" value="{{auth()->user()->email}}"/>
                        </div>
                    @endauth
                    @guest()
                        <x-form.input name="name"/>
                        <x-form.input name="email" type="email" autocomplete="email"/>
                    @endguest
                    <x-form.input name="topic"/>
                    <x-form.textarea name="text"></x-form.textarea>
                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
