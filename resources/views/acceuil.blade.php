@extends('layout')

@section('content')

<div class="relative w-full h-[700px] lg:h-[700px] bg-gray-100 mx-auto flex overflow-hidden">
    <div class="relative w-full h-full">
    {{-- Version mobile (visible uniquement sur mobile) --}}
    <div class="lg:hidden px-6 pt-4">
        <h1 class="text-3xl font-dancing mb-2 text-primary">
            Bienvenue à BKBG
        </h1>
        <h2 class="text-3xl font-bold font-raleway text-black leading-tight">
            Un hôtel où chaque moment est riche en émotions
        </h2>
        <p class="mt-3 text-sm font-medium font-raleway text-gray-600">
            Chaque instant semble être la première fois dans une vue paradisiaque
        </p>

        <div class="flex mt-6 gap-4">
            <a href="#" class="px-5 py-3 bg-[#C63031] text-white rounded-lg font-medium text-sm">
                Réservez maintenant !
            </a>
            <a href="#" class="flex items-center justify-center">
                <div class="flex items-center justify-center w-12 h-12 bg-[#0C4E99] text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                    </svg>
                </div>
                <span class="ml-2 text-sm font-medium">Visite Virtuelle</span>
            </a>
        </div>

        <div class="mt-8">
            <img src="{{ asset('images/hotelvue.png') }}" alt="Hôtel BKBG" class="w-full h-auto rounded-lg">
        </div>
    </div>

    {{-- Version desktop (première colonne) - masquée sur mobile --}}
    <div class="hidden lg:flex absolute top-0 left-0 w-[40%] h-full flex-col justify-center gap-5 ml-[10%]">
        <div class="display flex flex-col justify-items-start items-start h-full mt-20">
            <h1 class="text-5xl font-dancing mb-4 text-primary">
                Bienvenue à BKBG
            </h1>
            <h2 class="text-5xl font-bold font-raleway text-black leading-tight mt-4">
                Un hôtel où chaque moment est riche en émotions
            </h2>
            <p class="mt-4 text-sm font-medium font-raleway text-gray-600">
                Chaque instant semble être la première fois <br> dans une vue paradisiaque.
            </p>
            <a href="#" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-secondary text-white rounded-lg shadow-md">
                Visite Virtuelle
            </a>
        </div>
    </div>

    {{-- Version desktop (deuxième colonne) - masquée sur mobile --}}
    <div class="hidden lg:block absolute top-0 right-0 w-[40%] h-full mr-[10%]">
        <img src="{{ asset('images/hotelvue.png') }}" alt="Hôtel BKBG" class="w-full h-full object-cover">
    </div>

    {{-- Version desktop (formulaire réservation) - masqué sur mobile --}}
    <div class="hidden lg:block absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-[80%] mb-25 bg-white shadow-lg rounded-lg">
        <x-reservation-form />
    </div>
    </div>
</div>

<div class="mt-8">
    <h2 class="text-2xl lg:text-3xl font-medium font-poppins text-center text-black mb-2 lg:mb-4">Nos installations</h2>
    <p class="text-sm text-center mb-6 px-4">Nous vous proposons des installations hôtelières modernes pour votre confort.</p>

    {{-- Grid pour mobile, flex-wrap pour desktop --}}
    <div class="grid grid-cols-4 gap-y-6 lg:flex lg:flex-wrap lg:justify-center lg:gap-6 max-w-screen-lg mx-auto px-2">
        <x-installation-card icon="{{ asset('icons/swim.svg') }}" title="Piscine" />
        <x-installation-card icon="{{ asset('icons/wifi2.svg') }}" title="Wifi" />
        <x-installation-card icon="{{ asset('icons/dejeuner.svg') }}" title="Petit déjeuner" />
        <x-installation-card icon="{{ asset('icons/gym.svg') }}" title="Gymme" />
        <x-installation-card icon="{{ asset('icons/game.svg') }}" title="Centre de jeu" />
        <x-installation-card icon="{{ asset('icons/light.svg') }}" title="24/7 Lumière" />
        <x-installation-card icon="{{ asset('icons/lessive.svg') }}" title="Lessive" />
        <x-installation-card icon="{{ asset('icons/parking.svg') }}" title="Place de parking" />
    </div>
</div>

<div class="mt-16 px-6 md:px-12 lg:px-24">
    {{-- Section Chambres luxueuses --}}
    <div class="w-full h-auto backdrop-brightness-100  bg-cover bg-center flex flex-col items-center justify-center py-16" style="background-image: url('{{ asset('images/bg-acceuil.jpg') }}');">
        <h2 class="text-4xl md:text-5xl  font-medium font-raleway text-white text-center mb-4">Chambres luxueuses</h2>
        <p class="text-white text-center text-lg mb-8">
            Toutes les chambres sont conçues pour votre confort
        </p>
        <div class="flex flex-wrap justify-center gap-6 w-full ">
            <x-room-card-desc
                image="{{ asset('images/room.jpg') }}"
                label="Premium"
                description="Très spacieuses, bien équipées avec 2 lits doubles. Vue sur la Mer"
            />
            <x-room-card-desc
                image="{{ asset('images/room.jpg') }}"
                label="Privilege"
                description="Très spacieuses, bien équipées avec lit 3 places. Vue sur la Mer"
            />
            <x-room-card-desc
                image="{{ asset('images/room.jpg') }}"
                label="Senior"
                description="Très spacieuses, bien équipées avec lit double. Balcon avec vue sur la mer"
            />
            <x-room-card-desc
            image="{{ asset('images/room.jpg') }}"
            label="Senior"
            description="Très spacieuses, bien équipées avec lit double. Balcon avec vue sur la mer"
        />
        </div>
    </div>
</div>
<x-carousel-testimonies-card :testimonies="[
    ['date' => '2 Mars 2023',
    'stars' => 4,
    'text' => 'Le service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
L   orem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam....', 'image' => '/images/im.jpg', 'author' => 'Anthony Bruff'],

    ['date' => '25 Mars 2025',
    'stars' => 5,
    'text' => 'Le service à service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co l\'hôtel éLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam.tait exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Regina Gella'],

    ['date' => '5 Avril 2025', 'stars' => 3, 'text' => 'Le service service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co à l\'hôtel étaLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam.it exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Jamiyu Aliyu'],

    ['date' => '2 Mars 2023',
    'stars' => 4, 'text' => 'Le service à l\'hôtel Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam es service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit cot sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam.était exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Anthony Bruff'],

    ['date' => '25 Mars 2025',
    'stars' => 5,
    'text' => 'Le service à l\'hôteLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam es service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit cot sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam.l était exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Regina Gella'],

    ['date' => '5 Avril 2025',
    'stars' => 3,
    'text' => 'Le service à l\'hôtel était excLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam  service à l\'hôtel était exceptionnel
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit coest sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, faire voluptatum saepe iusto velit magnam.eptionnel...', 'image' => '/images/im.jpg', 'author' => 'Jamiyu Aliyu']
    ]" />

@endsection
