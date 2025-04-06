<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<div class="swiper-container relative">
    <div class="swiper-wrapper">
        @foreach ($testimonies as $testimony)
            <div class="swiper-slide flex justify-center items-center">
                <x-testimonies-card 
                    :date="$testimony['date']" 
                    :stars="$testimony['stars']" 
                    :text="$testimony['text']" 
                    :image="$testimony['image']" 
                    :author="$testimony['author']" 
                />
            </div>
        @endforeach
    </div>

    <!-- Navigation buttons -->
    <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2 bg-grey-500 text-white rounded-full w-8 h-8 flex justify-center items-center cursor-pointer hover:bg-gray-300">
        ❯
    </div>
    <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2 bg-grey-500 text-white rounded-full w-8 h-8 flex justify-center items-center cursor-pointer hover:bg-gray-300">
        ❮
    </div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 3,
        spaceBetween: 10,
    });
</script>

<style>
    .swiper-container {
        width: 100%;
        padding: 20px 0;
        overflow: hidden;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 470px; 
        height: 486px;
    }

    .testimony-card {
        width: 470px;
        height: 486px;
        border-radius: 10px;
        overflow: hidden; 
    }
</style>