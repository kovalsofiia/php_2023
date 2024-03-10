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
    <h1 class="text-3xl font-bold mb-4 text-blue-800">Students Index</h1>

    <table class="border border-blue-800">
        <thead>
        <tr class="bg-blue-800 text-white">
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Course</th>
            <th class="p-2">Specialty</th>
            <th class="p-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($students as $student)
            <tr class="border-t">
                <td class="p-2">{{ $student->id }}</td>
                <td class="p-2">{{ $student->name }}</td>
                <td class="p-2">{{ $student->course }}</td>
                <td class="p-2">{{ $student->specialty }}</td>
                <td class="p-2">
                    <a href="{{ route('students.show', $student->id) }}" class="text-blue-600 hover:underline mr-2">View</a>
                    <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No students found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
