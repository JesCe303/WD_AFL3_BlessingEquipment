<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    // Display branch list with search functionality
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Search by branch name if keyword exists
        // Pagination: 3 branches per page, appends() keeps search parameter in links
        if (isset($search)) {
            $branches = Branch::where('name_branch', 'LIKE', '%' . $search . '%')->paginate(3)->appends(['search' => $search]);
        } else {
            $branches = Branch::paginate(3);
        }

        // Return JSON for AJAX search requests
        if ($request->ajax()) {
            return response()->json(['branches' => $branches]);
        }

        return view('pages.branch.show', ['data_branch' => $branches]);
    }

    // Show add branch form
    public function create()
    {
        return view('pages.branch.add');
    }

    // Store new branch with image upload
    public function store(Request $request)
    {
        $request->validate([
            'name_branch' => 'required|max:150',
            'address_branch' => 'required',
            'type_branch' => 'required|max:50',
            'image_branch' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image_branch')) {
            $imagePath = $request->file('image_branch')->store('branches', 'public');
        }

        Branch::create([
            'name_branch' => $request->name_branch,
            'address_branch' => $request->address_branch,
            'type_branch' => $request->type_branch,
            'image_branch' => $imagePath
        ]);

        return redirect('/branch')->with('Message', 'Branch added successfully!');
    }

    // Show edit branch form
    public function edit($id)
    {
        $data = Branch::findOrFail($id);
        return view('pages.branch.edit', ['data' => $data]);
    }

    // Update existing branch with image handling
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_branch' => 'required|max:150',
            'address_branch' => 'required',
            'type_branch' => 'required|max:50',
            'image_branch' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $branch = Branch::findOrFail($id);

        // Handle image upload and delete old image
        $imagePath = $branch->image_branch;
        if ($request->hasFile('image_branch')) {
            // Delete old image if exists
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image_branch')->store('branches', 'public');
        }

        $branch->update([
            'name_branch' => $request->name_branch,
            'address_branch' => $request->address_branch,
            'type_branch' => $request->type_branch,
            'image_branch' => $imagePath
        ]);

        return redirect('/branch')->with('Message', 'Branch updated successfully!');
    }

    // Delete branch (protect Surabaya main branch)
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        // Prevent deletion of main branch (Surabaya)
        if ($branch->name_branch === 'Blessing Equipment Surabaya') {
            return redirect('/branch')->with('Error', 'Cannot delete main branch (Surabaya)!');
        }

        // Delete branch image if exists
        if ($branch->image_branch) {
            Storage::disk('public')->delete($branch->image_branch);
        }

        $branch->delete();
        return redirect('/branch')->with('Message', 'Branch deleted successfully!');
    }
}
