
{{-- filepath: resources/views/components/testimonies-card.blade.php --}}
<div class="testimony-card ">
    <div class="testimony-header">
        <span class="testimony-date">{{ $date }}</span>
        <div class="testimony-stars">
            @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $stars)
                <span class="filled-star">&#9733;</span> {{-- Étoile pleine --}}
            @else
                <span class="empty-star">&#9734;</span> {{-- Étoile vide --}}
            @endif
            @endfor
        </div>
    </div>
    <div class="testimony-content">
        <p class="testimony-text">"{{ $text }}"</p>
    </div>
    <div class="testimony-footer">
        <img src="{{ $image }}" alt="{{ $author }}" class="testimony-author-image">
        <span class="testimony-author">{{ $author }}</span>
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