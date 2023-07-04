<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function update(Request $request, About $about)
    {
        $validatedData = $request->validate([
            'description' => 'required'
        ]);
        
        About::where('id', $request->aboutId)
            ->update($validatedData);

        return redirect('/#about')->with('success', 'About has been modified');
    }
}
