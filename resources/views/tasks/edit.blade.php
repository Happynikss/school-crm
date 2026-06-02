<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Перевірка завдання та виставлення оцінки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Учень (закріплений)</label>
                        <select name="student_id" required class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 text-gray-600 shadow-sm">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $task->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Тема завдання</label>
                        <input type="text" name="title" value="{{ $task->title }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Опис умов</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $task->description }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Кінцевий термін (Дедлайн)</label>
                        <input type="date" name="due_date" value="{{ $task->due_date }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t pt-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Поточний статус</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="нове" {{ $task->status === 'нове' ? 'selected' : '' }}>Нове</option>
                                <option value="в процесі" {{ $task->status === 'в процесі' ? 'selected' : '' }}>В процесі</option>
                                <option value="завершено" {{ $task->status === 'завершено' ? 'selected' : '' }}>Завершено</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Оцінка (за 12-бальною системою)</label>
                            <input type="number" name="grade" value="{{ $task->grade }}" min="1" max="12" placeholder="Вкажіть бал" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-indigo-600">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">Назад</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">Зберегти зміни</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
