<h1>Update User Info</h1>

<form action="{{route('user.edit')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value={{$data['id']}}>
    <input type="text" name="name" value={{$data['name']}}> <br/><br/>
    <input type="text" name="email" value={{$data['email']}}> <br/><br/>
    <input type="text" name="password" value={{$data['password']}}> <br/><br/>
    <button type="submit">Update</button>
</form>

