{{-- filepath: resources/views/components/button.blade.php --}}
<div
    class="bg-primary font-poppins text-white text-center flex items-center justify-center cursor-pointer"
    style="width: {{ $width }}; height: {{ $height }}; border-radius: {{ $cornerRadius }}; fontweight: {{ $fontweight}};"
    {{ $attributes }}
>
    {{ $slot }}
</div>
