<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks/') }} <span>{{ __('Update') }}</span>
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('patch')
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $task->name)" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <x-input-label for="name" :value="__('Priority')" />
            <select name="priority_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>{{ __('Chose Priority') }}</option>
                @foreach ($priorities as $priority)
                    <option {{ $priority->id == $task->priority_id ? 'selected' : '' }} value="{{ $priority->id }}">
                        {{ $priority->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('priority_id')" class="mt-2" />

            <x-input-label for="name" :value="__('Project')" />
            <select name="project_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>{{ __('Chose Project') }}</option>
                @foreach ($projects as $project)
                    <option {{ $project->id == $task->project_id ? 'selected' : '' }} value="{{ $project->id }}">
                        {{ $project->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />

            <x-primary-button class="mt-4">{{ __('Edit Task') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
