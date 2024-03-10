<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4 text-blue-800">Show</h1>
    <a href="{{ route('students.index') }}" class="text-darkblue font-bold hover:underline">Back</a>

    <table class="border border-blue-800 mt-4">
        <thead>
        <tr class="bg-blue-800 text-white">
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Course</th>
            <th class="p-2">Specialty</th>
            <th class="p-2">Grades</th>
        </tr>
        </thead>
        <tbody>
        @if($student)
            <tr class="border-t">
                <td class="p-2">{{ $student->id }}</td>
                <td class="p-2">{{ $student->name }}</td>
                <td class="p-2">{{ $student->course }}</td>
                <td class="p-2">{{ $student->specialty }}</td>
                <td class="p-2">
                    @foreach($achievements as $achievement)
                        {{ $achievement->score }}
                        @unless($loop->last), @endunless
                    @endforeach
                </td>
            </tr>
        @else
            <tr>
                <td colspan="5" class="p-2">Student not found</td>
            </tr>
        @endif
        </tbody>
    </table>

    <h2 class="text-2xl font-bold mb-2 mt-4 text-blue-800">Achievements</h2>

    <table class="border border-blue-800">
        <thead>
        <tr class="bg-blue-800 text-white">
            <th class="p-2">ID</th>
            <th class="p-2">Subject</th>
            <th class="p-2">Score</th>
            <th class="p-2">Achievement Date</th>
            <th class="p-2">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($achievements as $achievement)
            <tr class="border-t">
                <td class="p-2">{{ $achievement->id }}</td>
                <td class="p-2">{{ $achievement->subject }}</td>
                <td class="p-2">{{ $achievement->score }}</td>
                <td class="p-2">{{ $achievement->achievement_date }}</td>
                <td class="p-2">
                    <a href="{{ route('students.confirmDeleteAchievement', ['student_id' => $student->id, 'achievement_id' => $achievement->id]) }}"
                       class="text-red-600 hover:underline">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-2">No achievements</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
