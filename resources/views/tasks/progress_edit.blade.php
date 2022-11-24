<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-10">
        <h1 class="text-3xl text-center font-semibold p-6">進捗の登録</h1>

        <x-validation-errors :errors="$errors" />


        <form action="/tasks/progress/{{ $task->id }}" method="POST" class="relative px-6 pb-6 flex-auto">

            @csrf
            @method('PATCH')

            <div>{{ $task->subject->subject_text }}</div>
            <div>{{ $task->title }}</div>
            <div>{{ $task->body }}</div>
            <br>
            <div>予定所要時間：{{ $task->total_page }}p × {{ $task->page_time }}分 = {{ $task->total_time }}分</div>
            <div>進んだ時間　：{{ $task->finish_page }}p × {{ $task->page_time }}分 = {{ $task->progress_time }}分</div>
            <div>残りの時間　：{{ $task->remaining_page }}p × {{ $task->page_time }}分 = {{ $task->remaining_time }}分</div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mt-5 mb-2" for="body">
                    進んだページ数を登録
                </label>
                <input type="text" name="finish_page" id="finish_page" placeholder="ページ数"
                    value="{{ old('title', $task->finish_page) }}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mt-5 mb-2" for="body">
                    進捗状況を選択
                </label>
                @foreach ($states as $state)
                    <label>
                        <input type="radio" name="state_id" id='state_text'
                            value="{{ $state->id }}"{{ old('state_id', $task->state->id) == $state->id ? 'checked' : '' }}>{{ $state->state_text }}
                    </label>
                @endforeach
            </div>



            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold mt-5 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>

    </div>
</x-app-layout>
