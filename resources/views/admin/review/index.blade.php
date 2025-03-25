@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <a href="{{ route('admin.tour_management.show', $tour->id) }}" class="p-2 rounded" style="color: black; text-decoration: none;">
        <i class="fa-solid fa-arrow-left me-2"></i>Quay lại
    </a>
    <h5 class="mb-4 mt-4">Đánh giá cho tour: <span class="text-primary">{{ $tour->name }}</span></h3>
    @if($tour->reviews->count() > 0)
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Người đánh giá</th>
                    <th>Địa chỉ email</th>
                    <th>Số sao</th>
                    <th>Bình luận</th>
                    <th>Ngày đánh giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tour->reviews as $index => $review)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $review->user->name ?? 'User ID: '.$review->user_id }} </td>
                        <td>{{ $review->user->email ?? 'User ID: '.$review->user_id }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fas fa-star text-warning"></i> {{-- Sao đầy --}}
                                @else
                                    <i class="far fa-star text-warning"></i> {{-- Sao rỗng --}}
                                @endif
                            @endfor
                        </td>
                        <td>{{ $review->comment ?? '(Không có bình luận)' }}</td>
                        <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này không?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Chưa có đánh giá nào cho tour này.</p>
    @endif
</div>
@endsection
