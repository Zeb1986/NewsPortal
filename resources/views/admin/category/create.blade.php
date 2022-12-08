<x-layout>
    <x-settings heading="Create category">
        <form method="POST" action="/admin/category/create" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name"/>
            <x-form.input name="slug"/>
            <x-form.button>Create</x-form.button>
        </form>
    </x-settings>
</x-layout>
