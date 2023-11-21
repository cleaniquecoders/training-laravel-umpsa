<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                {{ $tasks->links() }}
                <table class="w-full">
                    <tr>
                        <th>Status</th>
                        <th>Task</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="text-center">
                                {{ $task->status ? '✅' : '◻️' }}
                            </td>
                            <td class="px-4">{{ $task->title }}</td>
                            <td class="text-center">
                                <a class="px-1" href="{{ route('tasks.show', $task->id) }}">🔎</a>
                                <a class="px-1" href="{{ route('tasks.edit', $task->id) }}">✏️</a>
                                <a class="px-1" href="{{ route('tasks.destroy', $task->id) }}">🗑️</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>