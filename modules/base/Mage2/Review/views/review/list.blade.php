@if(count($product->reviews) >0)
<table class="bordered">
    <tr>
        <th>Name</th>
        <th>Rating</th>
        <th>Comment</th>
    </tr>
    
    @foreach($product->reviews as $review)
    <tr>
        <td>{{$review->user->full_name }} </td>
        <td>{{ $review->star }}</td>
        <td>{{ $review->comment }}</td>
    </tr>
    @endforeach
</table>
@endif