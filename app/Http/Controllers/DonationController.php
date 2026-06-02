<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with(['category', 'user'])->latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        // API JSON
        if ($request->wantsJson()) {
            $donations = $query->get();
            return response()->json([
                'status' => 'success',
                'data' => $donations,
                'count' => count($donations)
            ]);
        }

        // Web HTML
        $donations = $query->paginate(12);
        $categories = Category::all();

        return view('home', compact('donations', 'categories'));
    }

    public function show($id)
    {
        $donation = Donation::with(['category', 'user'])->findOrFail($id);
        
        // API JSON
        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $donation
            ]);
        }
        
        // Web HTML
        return view('donation.show', compact('donation'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('donate.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|string',
            'location' => 'required|string',
            'whatsapp' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/donations'), $imageName);
            $imagePath = 'images/donations/'.$imageName;
        }

        $donation = Donation::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'location' => $request->location,
            'whatsapp' => $request->whatsapp,
            'user_id' => Auth::id(),
        ]);

        // API JSON
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Donation créée avec succès',
                'data' => $donation
            ], 201);
        }

        // Web redirect
        return redirect()->route('home')->with('success', 'Donation publiée avec succès !(ربي يجازيك بالخير)');
    }

    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        // Vérifier que l'utilisateur est le propriétaire
        if ($donation->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Non autorisé à modifier cette donation'
            ], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'quantity' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'whatsapp' => 'sometimes|required|string',
            'status' => 'sometimes|in:available,pending,given',
        ]);

        $donation->update($request->only(['title', 'description', 'category_id', 'quantity', 'location', 'whatsapp', 'status']));

        return response()->json([
            'status' => 'success',
            'message' => 'Donation mise à jour avec succès',
            'data' => $donation
        ]);
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);

        // Vérifier que l'utilisateur est le propriétaire
        if ($donation->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Non autorisé à supprimer cette donation'
            ], 403);
        }

        $donation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donation supprimée avec succès'
        ]);
    }
}
