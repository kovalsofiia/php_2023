<h1>Achievements Index</h1>
<table border="3">
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Subject</th>
        <th>Score</th>
        <th>Achievement Date</th>
        <th>Actions</th>
    </tr>
    @foreach($achievements as $achievement)
        <tr>
            <td>{{ $achievement->id }}</td>
            <td>{{ $achievement->student->name }}</td>
            <td>{{ $achievement->subject }}</td>
            <td>{{ $achievement->score }}</td>
            <td>{{ $achievement->achievement_date }}</td>
            <td>
                <form method="POST" action="{{ route('achievements.destroy', $achievement->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
