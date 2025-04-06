@extends('layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">

   {{-- Profile Card --}}

  
    <x-carousel-testimonies-card :testimonies="[
    ['date' => '2 Mars 2023', 
    'stars' => 4, 
    'text' => 'Le service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
L   orem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam....', 'image' => '/images/im.jpg', 'author' => 'Anthony Bruff'],
   
    ['date' => '25 Mars 2025', 
    'stars' => 5, 
    'text' => 'Le service à service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co l\'hôtel éLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam.tait exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Regina Gella'],
  
    ['date' => '5 Avril 2025', 'stars' => 3, 'text' => 'Le service service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit co à l\'hôtel étaLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam.it exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Jamiyu Aliyu'],
    
    ['date' => '2 Mars 2023', 
    'stars' => 4, 'text' => 'Le service à l\'hôtel Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam es service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit cot sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam.était exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Anthony Bruff'],
   
    ['date' => '25 Mars 2025', 
    'stars' => 5, 
    'text' => 'Le service à l\'hôteLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam es service à l\'hôtel était exceptionnel
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit cot sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam.l était exceptionnel...', 'image' => '/images/im.jpg', 'author' => 'Regina Gella'],
    
    ['date' => '5 Avril 2025', 
    'stars' => 3, 
    'text' => 'Le service à l\'hôtel était excLorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam  service à l\'hôtel était exceptionnel
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus non eum laboriosam fugit natus incidunt eaque ab suscipit nesciunt cupiditate, commodi officiis explicabo tempora fuga vero doloribus sed ut distinctio.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam est sit coest sit consequatur tempore itaque a, dolores consectetur at molestiae expedita beatae delectus quibusdam ipsum, facere voluptatum saepe iusto velit magnam.eptionnel...', 'image' => '/images/im.jpg', 'author' => 'Jamiyu Aliyu']
    ]" />  




  {{-- Reservation Form --}}
  <div class="mt-8 flex items-center justify-center">
    <x-reservation-form />
</div>

</div>
@endsection
