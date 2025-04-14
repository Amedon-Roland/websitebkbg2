{{-- filepath: d:\BKBG\websitebkbg2\resources\views\components\client-list.blade.php --}}
<div class="image-container">
    @foreach ($imageLinks as $link)
        <img src="{{ $link }}" alt="Image" class="responsive-image">
    @endforeach
</div>

<style>
    .image-container {
        display: flex;
        justify-content: space-between; /* Ajoute un espacement égal entre les images */
        align-items: center; /* Aligne les images verticalement */
        flex-wrap: wrap; /* Permet aux images d'aller à la ligne si nécessaire */
        gap: 20px; /* Ajoute un espacement plus grand entre les images */
        position: relative;
        width: 100%; /* S'adapte à la largeur de l'écran */
        max-width: 613px; /* Largeur maximale pour les grands écrans */
        margin: 0 auto; /* Centre le conteneur horizontalement */
        padding: 10px; /* Ajoute un peu d'espace intérieur */
    }

    .responsive-image {
        width: 100px; /* Taille fixe pour garantir que toutes les images soient identiques */
        height: 100px; /* Taille fixe pour garantir que toutes les images soient identiques */
        object-fit: contain; /* Ajuste l'image pour qu'elle s'adapte sans déformation */
        border: 1px solid #ddd; /* Optionnel : ajoute une bordure pour mieux visualiser les images */
        padding: 5px; /* Ajoute un peu d'espace intérieur autour des images */
        background-color: #fff; /* Optionnel : ajoute un fond blanc pour uniformiser */
    }

    @media (max-width: 768px) {
        .responsive-image {
            width: 80px; /* Réduit la taille des images sur les écrans moyens */
            height: 80px;
        }
    }

    @media (max-width: 480px) {
        .responsive-image {
            width: 60px; /* Réduit encore plus la taille des images sur les petits écrans */
            height: 60px;
        }
    }
</style>