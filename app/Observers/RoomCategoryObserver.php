<?php

namespace App\Observers;

use App\Models\RoomCategory;
use App\Models\RoomCategoryImage;

class RoomCategoryObserver
{
    /**
     * Handle the RoomCategory "created" event.
     */
    public function created(RoomCategory $roomCategory): void
    {
        //
    }

    /**
     * Handle the RoomCategory "updated" event.
     */
    public function updated(RoomCategory $roomCategory): void
    {
        //
    }

    /**
     * Handle the RoomCategory "deleted" event.
     */
    public function deleted(RoomCategory $roomCategory): void
    {
        //
    }

    /**
     * Handle the RoomCategory "restored" event.
     */
    public function restored(RoomCategory $roomCategory): void
    {
        //
    }

    /**
     * Handle the RoomCategory "force deleted" event.
     */
    public function forceDeleted(RoomCategory $roomCategory): void
    {
        //
    }

    public function saved(RoomCategory $roomCategory)
    {
        // Gère les images de la galerie
        if (request()->has('gallery')) {
            $gallery = request()->input('gallery');
            
            // Supprimer les anciennes images
            if (is_array($gallery) && !empty($gallery)) {
                $roomCategory->galleryImages()->delete();
                
                // Ajouter les nouvelles images
                $order = 0;
                foreach ($gallery as $image) {
                    $roomCategory->galleryImages()->create([
                        'image' => $image,
                        'order' => $order++
                    ]);
                }
            }
        }
    }
}
