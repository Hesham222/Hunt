<?php

namespace App\Modules\Admin\Models\Listings;

use Admin\Models\Individual;
use Admin\Models\Listings\Listing;
use Admin\Models\Posts\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingFavourite extends Model
{
    use HasFactory;

    public function listing(){

        return $this->belongsTo(Listing::class,'listing_id');
    }

    public function individual(){

        return $this->belongsTo(Individual::class,'individual_id');
    }
}
