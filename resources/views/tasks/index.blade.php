<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('tasks.create') }}">Create New Task</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                {{ $tasks->links() }}
                <table class="w-full">
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Task</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="text-center">
                                {{ $task->status ? '✅' : '◻️' }}
                            </td>
                            <td class="px-4">{{ $task->user->name }}</td>
                            <td class="px-4">{{ $task->title }}</td>
                            <td class="text-center">
                                <div class="flex">
                                    @can('view', $task)
                                        <a class="px-1" href="{{ route('tasks.show', $task->id) }}">🔎</a>
                                    @endcan


                                    @can('update', $task)
                                        <a class="px-1" href="{{ route('tasks.edit', $task->id) }}">✏️</a>
                                    @endcan

                                    @can('delete', $task)
                                        <form action="{{ route('tasks.destroy', $task->id) }}"
                                            class="hover:underline cursor-pointer" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="px-1"
                                                onclick="
                            if(confirm('Are you sure want to delete {{ $task->title }}?')) {
                                this.parentElement.submit()
                            }">
                                                🗑️</div>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
