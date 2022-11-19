<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-10">
        <h1 class="text-3xl text-center font-semibold p-6">{{ __('課題詳細') }}</h1>

        <x-flash-message :message="session('notice')" />

        <div class="px-6 pb-6">
            <div>{{ $task->subject->subject_text }}</div>
            <div>{{ $task->title }}</div>
            <div>{{ $task->body }}</div>
            <div class="mt-3">予定所要時間：{{ $task->total_page }}p × {{ $task->page_time }}分 = {{ $task->total_time }}分
            </div>
            <div>進んだ時間　：{{ $task->finish_page }}p × {{ $task->page_time }}分 = {{ $task->progress_time }}分</div>
            <div>残りの時間　：{{ $task->total_page }}p × {{ $task->page_time }}分 = {{ $task->remaining_time }}分</div>

            <div class="flex flex-row text-center my-4">
                <a href="javascript:history.back()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">
                    {{ __('Go back') }}
                </a>
                <a href="{{ route('tasks.edit', $task) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">
                    {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
