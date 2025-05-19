{{-- filepath: resources/views/components/testimonies-card.blade.php --}}
<div class="card bg-base-100 hover:bg-base-50 border border-base-200 shadow-md hover:shadow-lg transition-all duration-300 h-full overflow-hidden group">
    {{-- Card Header with Stars and Date --}}
    <div class="card-body p-6 relative">
        {{-- Quote Icon Background --}}
        <div class="absolute -top-1 -right-1 text-base-200 opacity-20 group-hover:opacity-40 transition-opacity duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
            </svg>
        </div>
        
        {{-- Date and Rating --}}
        <div class="flex justify-between items-center mb-4 z-10">
            <div class="badge badge-ghost text-xs md:text-sm">{{ $date }}</div>
            <div class="rating rating-sm md:rating-md">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $stars)
                        <input type="radio" name="rating-{{ $author }}" class="mask mask-star-2 bg-warning" checked disabled />
                    @else
                        <input type="radio" name="rating-{{ $author }}" class="mask mask-star-2 bg-base-300" disabled />
                    @endif
                @endfor
            </div>
        </div>
        
        {{-- Testimony Content --}}
        <div class="mb-6 relative z-10">
            <p class="text-base-content/80 text-sm md:text-base font-light leading-relaxed italic line-clamp-6">
                "{{ $text }}"
            </p>
        </div>
        
        {{-- Author Info --}}
        <div class="flex items-center gap-3 mt-auto pt-4 border-t border-base-200 z-10">
            <div class="avatar">
                <div class="w-10 h-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="{{ $image }}" alt="{{ $author }}" />
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-sm md:text-base">{{ $author }}</h3>
                @if(isset($role))
                    <p class="text-xs text-base-content/60">{{ $role }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .testimony-card {
        
        border-radius: 10px;
        padding: 16px;
        background-color: #FAFAFA;
        max-width: 470px;
        height: 486px;

    }
    .testimony-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .testimony-date {
        font-size: 0.9em;
        color: #888;
    }
    .testimony-stars span {
        color: gold;
        font-size: 1.2em;
    }
    .empty-star {
        color: #ddd;
    }
    .testimony-content {
        margin: 16px 0;
    }
    .testimony-text {
        font-style: italic;
    }
    .testimony-footer {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .testimony-author-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .testimony-author {
        font-weight: bold;
    }
</style>