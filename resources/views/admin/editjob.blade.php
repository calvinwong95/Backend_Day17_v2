<h1>Update Job Info</h1>

<form action="{{route('job.edit')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value={{$data['id']}}>
    <input type="text" name="title" value={{$data['title']}}> <br/><br/>
    <input type="text" name="description" value={{$data['description']}}> <br/><br/>
    <input type="text" name="min_salary" value={{$data['min_salary']}}> <br/><br/>
    <input type="text" name="mas_salary" value={{$data['mas_salary']}}> <br/><br/>
    <button type="submit">Update</button>
</form>
