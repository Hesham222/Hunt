<?php

namespace Admin\Http\Controllers;
use Admin\Models\Developer;
use Admin\Models\Listings\Listing;
use User\Models\{
    User,
};
use Admin\Models\{
    Individual,
    Broker,
    Posts\Post,
};


class DashboardController extends JsonResponse
{
    public function __invoke()
    {
        // individuals statistics
        $individuals = Individual::count();
        $posts = Post::count();

        // brokers statistics
        $brokers = Broker::count();
        $listings = Listing::count();
        $unavailableListings = Listing::where('listing_status_id',3)->count();

        //developers statistics
        $developers = Developer::count();

        $statistics = array(
            //individuals
            'individuals' => $individuals,
            'posts' => $posts,
            //brokers
            'brokers' => $brokers,
            'listings' => $listings,
            'unavailableListings' => $unavailableListings,
            //developers
            'developers' => $developers,
        );
        return view('Admin::home', compact('statistics'));
    }
}
