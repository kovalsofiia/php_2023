<h1>Confirm Deletion</h1>

<p>Are you sure you want to delete the achievement with ID: {{ $achievement->id }}?</p>

<form method="POST" action="{{ route('students.destroyAchievement', ['student_id' => $student_id, 'achievement_id' => $achievement_id]) }}">
    @csrf
    @method('DELETE')

    <button type="submit">Confirm Delete</button>
</form>

<a href="{{ route('students.show', $student_id) }}">Cancel</a>
