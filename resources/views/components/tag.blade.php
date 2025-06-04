@props(['size' => 'sm'])
<a
    {{ $attributes->merge([
        'class' => "inline-block space-y-2 text-$size capitalize bg-white/20 hover:bg-white/30
            px-4 py-1 rounded-2xl font-bold",
        'href'  => "/tags/" . strtolower($slot)
    ]) }}
>
    {{ strtolower($slot)  }}
</a>
