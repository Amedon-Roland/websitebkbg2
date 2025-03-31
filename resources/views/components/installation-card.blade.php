{{-- filepath: resources/views/components/installation-card.blade.php --}}
<div class="w-[280px] h-[250px] bg-background shadow-md flex flex-col items-center rounded-[5px] justify-center hover:shadow-lg transition-shadow duration-300">
    {{-- Icon --}}
    <img src="{{ $icon }}" alt="{{ $title }}" class="w-13 h-[40px] mb-2">

    {{-- Title --}}
    <p class="text-secondary font-poppins font-medium text-center">{{ $title }}</p>
</div>
