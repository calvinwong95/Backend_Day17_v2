<h1>Update Department Info</h1>

<form action="{{route('dept.edit')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value={{$data['id']}}>
    <input type="text" name="name" value={{$data['name']}}> <br/><br/>

    <button type="submit">Update</button>
</form>
