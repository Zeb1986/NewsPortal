@props(['name'])
<x-form.field>
    <x-form.label name="{{$name}}"/>
    <input
        class="border border-gray-200 w-full p-2 rounded"
        name="{{$name}}"
        id="{{$name}}"
        {{$attributes(['value' => old($name)])}}
    >
<x-form.error name="{{$name}}"/>
</x-form.field>
