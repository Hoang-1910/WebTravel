<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    //
    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'tour_id' => $tour->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }

    public function showReview($tourID)
{
    $tour = Tour::with('reviews')->findOrFail($tourID);  // Nhớ load luôn user
    return view('admin.review.index', compact('tour'));
}

}
