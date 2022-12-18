<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-6 pb-16">
        <h1 class="text-3xl text-center font-semibold p-6">課題の編集</h1>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="relative px-6 pb-2 flex-auto">

            @csrf
            @method('PATCH')

            <div class="mb-4 mr-10 float-left">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    イベントを選択
                </label>
                <select class="text-sm rounded" name="event_id" id="event">
                    <option value="" hidden>選択してください</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" @if (old('event_id', $task->event->id) == $event->id) selected @endif>
                            {{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                イベントを選択
            </label>
            <div>
                @foreach ($events as $event)
                    <label>
                        <input type="radio" name="event_id" id='event'
                            value="{{ $event->id }}"{{ old('event_id', $task->event->id) == $event->id ? 'checked' : '' }}>{{ $event->event_name }}
                    </label>
                @endforeach
            </div> --}}


            <div class="mb-4">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    教科を選択
                </label>
                <select class="text-sm rounded" name="subject_id" id="subject_te">
                    <option value="" hidden>選択してください</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @if (old('subject_id', $task->subject->id) == $subject->id) selected @endif>
                            {{ $subject->subject_text }}</option>
                    @endforeach
                </select>
            </div>


            {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                教科を選択
            </label>

            <div>
                @foreach ($subjects as $subject)
                    <label>
                        <input type="radio" name="subject_id" id='subject_text'
                            value="{{ $subject->id }}"{{ old('subject_id', $task->subject->id) == $subject->id ? 'checked' : '' }}>{{ $subject->subject_text }}
                    </label>
                @endforeach
            </div> --}}


            <div class="mb-4 leading-relaxed">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    タイトルを入力
                </label>
                <input type="text" name="title" id="title" placeholder="{{ __('Event Name') }}"
                    value="{{ old('title', $task->title) }}" required
                    class="placeholder-gray-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-3 leading-relaxed">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="body">
                    メモを入力
                </label>
                <textarea name="body" id="body" placeholder="メモ"
                    placeholder="メモ"class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32">{{ old('body', $task->body) }}</textarea>
            </div>


            <div class="mb-4 mr-10 float-left">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    ページ数を登録
                </label>
                <select class="text-sm rounded" name="total_page">
                    <option value="{{ $task->total_page }}" hidden>{{ old('title', $task->total_page) }} ページ</option>
                    <?php //PHPで動的に選択肢を追加
                    for ($i = 1; $i <= 30; $i++) {
                        echo '<option value = "' . $i . '">' . $i . ' ページ' . '</option>';
                    }
                    ?>
                </select>
            </div>

            {{-- <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    ページ数を登録
                </label>
                <input type="text" name="total_page" id="total_page" placeholder="ページ数"
                    value="{{ old('title', $task->total_page) }}">
            </div> --}}


            <div class="mb-4">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    1pあたりの所要時間を登録
                </label>
                <select class="text-sm rounded" name="page_time">
                    <option value="{{ $task->page_time }}" hidden>{{ old('title', $task->page_time) }} 分</option>
                    <?php //PHPで動的に選択肢を追加
                    for ($j = 5; $j <= 120; $j = $j + 5) {
                        echo '<option value = "' . $j . '">' . $j . ' 分' . '</option>';
                    }
                    ?>
                </select>
            </div>


            {{-- <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    1pあたりの所要時間を登録
                </label>
                <input type="text" name="page_time" id="page_time" placeholder="1pあたりの所要時間"
                    value="{{ old('title', $task->page_time) }}">
            </div> --}}


            <input type="submit" value="更新"
                class="mt-2 w-[185px] float-left bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>

        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
            class="float-right relative px-6 pb-2 flex-auto">
            @csrf
            @method('DELETE')
            <input type="submit" value="{{ __('Delete') }}" onclick="if(!confirm('削除しますか？')){return false};"
                class="mb-6 w-[185px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>

    </div>
</x-app-layout>
