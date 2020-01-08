<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;

class UserProfileRatingController extends Controller
{
    /**
     * Rate the given UserProfile.
     *
     * @param \App\UserProfile $userprofile
     */
    public function store(UserProfile $userprofile)
    {
        request()->validate([
            'rating' => ['required', 'in:1,2,3,4,5']
        ]);
        $userprofile->rate(request('rating'));
    }
}
