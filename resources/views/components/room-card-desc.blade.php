{{-- filepath: resources/views/components/room-card-desc.blade.php --}}
<div class="w-[385px] h-[384px] bg-white rounded-[5px] shadow-md flex flex-col items-center justify-center gap-4">
    {{-- Image Section --}}
    <div class="relative">
        <img src="{{ $image }}" alt="Room Image" class="h-[285px] w-[330px] object-cover rounded-[5px]">
        <span class="absolute rounded-[2.5px] top-2 right-2 bg-primary text-white text-xs font-bold px-3 py-1">
            {{ $label }}
        </span>
    </div>

    {{-- Description Section --}}
    <div class="text-center mr-5 ml-5">
        <p class="text-sm text-gray-700 font-raleway">
            {{ $description }}
        </p>
    </div>
</div>
