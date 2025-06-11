@props(['for'])

<div class="flex items-center space-x-2">
    <span class="block w-2 h-2 bg-white"></span>
    <label for="{{ $for }}" class="font-bold text-lg">{{ $slot }}</label>
</div>

