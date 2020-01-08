<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;

class UserProfileController extends Controller
{
    public function show(UserProfile $userprofile)
    {
        return view ('userprofile.show', compact('userprofile'));
    }
}

