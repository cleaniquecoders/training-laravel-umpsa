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

                    <form method="POST" action="{{ route('tasks.store') }}" class="" >
                        @csrf

                        <div class="col-span-6 sm:col-span-4 my-4">
                            <x-label for="title" value="{{ __('Task') }}" />
                            <x-input id="title" name="title" type="text" class="mt-1 block w-full" />
                            <x-input-error for="title" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-button type="submit">Save</x-button>
                        </div>
                    </form>

                    {{-- <a class="px-1" href="{{ route('tasks.index') }}">Cancel</a> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
