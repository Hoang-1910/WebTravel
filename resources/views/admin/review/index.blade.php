@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Danh sách đánh giá cho tour: <span class="text-primary">{{ $tour->name }}</span></h3>
    
    @if($tour->reviews->count() > 0)
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Người đánh giá</th>
                    <th>Số sao</th>
                    <th>Bình luận</th>
                    <th>Ngày đánh giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tour->reviews as $index => $review)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $review->user->name ?? 'User ID: '.$review->user_id }}
                          </td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                            @endfor
                        </td>
                        <td>{{ $review->comment ?? '(Không có bình luận)' }}</td>
                        <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Chưa có đánh giá nào cho tour này.</p>
    @endif
</div>
@endsection
