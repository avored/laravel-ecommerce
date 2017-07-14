@if(count($reviews = $product->getReviews()) >0)
    <table class="table table-responsive">
        <tr>
            <th>Name</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>

        @foreach($reviews as $review)

            <tr>
                <td>{{$review->user->full_name }} </td>
                <td>{{ $review->star }}</td>
                <td>{{ $review->comment }}</td>
            </tr>
        @endforeach
    </table>
@endif