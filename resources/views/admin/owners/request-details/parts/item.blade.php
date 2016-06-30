<tr role="row" class="odd">
    <td>{{ $detail->center->name }}</td>
    <td>{{ $detail->i_would_like_to }}</td>
    <td>{{ $detail->notes }}</td>
    <td>
        <a href="{{ url('owners/request-detail/'.$detail->id) }}">details</a>
        <a href="">accept</a>
        <a href="">decline</a>
    </td>
</tr>