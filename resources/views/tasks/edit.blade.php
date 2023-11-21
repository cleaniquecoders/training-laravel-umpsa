<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">

                <div class="my-4">
                    <a class="px-1" href="{{ route('tasks.index') }}">Back to Listing</a>
                    <a class="px-1" href="{{ route('tasks.show', $task->id) }}">Back to Details</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
