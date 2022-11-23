
    <th scope="row" class="mt-2 badge bg-primary">Edited</th>
    <td style="max-width: 50px">{{ $post->title }}</td>
    <td style="max-width: 100px">{{ $post->desc }}</td>
    <td style="max-width: 30px">
        <strong>
            {{ $post->updated_at->diffForHumans() }}
        </strong>
    </td>
    <td style="max-width: 70px">
        <button type="button" class="btn btn-dark btn-sm edit-post" data-route={{route('edit.post' , $post->id)}} data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo">Edit</button>
        <a class="btn btn-sm btn-danger text-white delete-post" data-route="{{route('delete.post' , $post->id)}}">Delete</a>
    </td>
