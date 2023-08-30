<?php

namespace App\Http\Controllers;

use App\Models\admin\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();
        return view('meals.index', ['meals' => $meals]);
    }

    public function create()
    {
        return view('admin.meals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|in:breakfast,lunch,dinner',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
        ]);

        // Handle image upload (you can customize this part)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meal_images', 'public');
        } else {
            $imagePath = null;
        }

        Meal::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'image' => $imagePath,
        ]);

        return redirect()->route('meals.index')->with('success', 'Meal added successfully.');
    }

    public function show(Meal $meal)
    {
        return view('meals.show', ['meal' => $meal]);
    }

    public function edit(Meal $meal)
    {
        return view('meals.edit', ['meal' => $meal]);
    }

    public function update(Request $request, Meal $meal)
    {
        // Validation and update logic here
        // Similar to the store method

        return redirect()->route('meals.index')->with('success', 'Meal updated successfully.');
    }

    // Remove the specified meal from the database
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return redirect()->route('meals.index')->with('success', 'Meal deleted successfully.');
    }
}
