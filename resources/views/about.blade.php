@extends('layout')

@section('content')

<x-image-hero-section
    backgroundImage="{{ asset('images/treehero.jpg') }}"
    title="À propos de nous"
    description="Les chambres de luxe élégantes de cette galerie présentent des designs d'intérieur et des idées de décoration personnalisés.
    Regardez les photos et trouvez votre design de chambre de luxe idéal."
    :showScrollButton="false"
/>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Profile Card Column --}}
        <div class="w-full lg:w-5/12">
            <x-profile-card 
                image="{{ asset('images/im.jpg') }}" 
                name="Chidinma James" 
                role="Manager" 
                
            />
        </div>

        {{-- Text Content Column --}}
        <div class="w-full lg:w-7/12">
            <div class="font-mulish text-base leading-relaxed space-y-6 text-justify">
                <p>
                    The United Nations is an international organization founded in 1945. Currently made up of 193 Member States, the UN and its work are guided by the purposes and principles contained in its founding Charter.
                    The UN has evolved over the years to keep pace with a rapidly changing world.
                    But one thing has stayed the same: it remains the one place on Earth where all the world's nations can gather together, discuss common problems, and find shared solutions that benefit all of humanity. The Secretary-General is Chief Administrative Officer of the UN – and is also a symbol of the Organization's ideals and an advocate for all the world's peoples, especially the poor and vulnerable.
                </p>
                <p>
                    The Secretary-General is appointed by the General Assembly on the recommendation of the Security Council for a 5-year, renewable term.
                    The current Secretary-General, and the 9th occupant of the post, is António Guterres of Portugal, who took office on 1 January 2017.
                    On the 18th of June, 2021, Guterres was re-appointed to a second term, pledging as his priority to continue helping the world chart a course out of the COVID-19 pandemic.
                </p>
                <p>
                    The United Nations is an international organization founded in 1945. Currently made up of 193 Member States, the UN and its work are guided by the purposes and principles contained in its founding Charter.
                    The UN has evolved over the years to keep pace with a rapidly changing world.
                    But one thing has stayed the same: it remains the one place on Earth where all the world's nations can gather together, discuss common problems, and find shared solutions that benefit all of humanity. The Secretary-General is Chief Administrative Officer of the UN – and is also a symbol of the Organization's ideals and an advocate for all the world's peoples, especially the poor and vulnerable.
                </p>
                <p>
                    The Secretary-General is appointed by the General Assembly on the recommendation of the Security Council for a 5-year, renewable term.
                    The current Secretary-General, and the 9th occupant of the post, is António Guterres of Portugal, who took office on 1 January 2017.
                    On the 18th of June, 2021, Guterres was re-appointed to a second term, pledging as his priority to continue helping the world chart a course out of the COVID-19 pandemic.
                </p>
                
            </div>
        </div>
    </div>
</div>


<div class="mt-16 px-6 md:px-12 lg:px-24 mb-5">
    <h2 class="text-3xl md:text-4xl font-medium font-poppins text-center text-black mb-4">Clients</h2>
    {{-- Exemple d'utilisation dans une vue --}}
    <x-client-list :image-links="['/images/ncc.png', '/images/nirsal.png', '/images/nncp.png' ,'/images/unicef.png' , '/images/ccofnageria.png']" />
</div>


@endsection