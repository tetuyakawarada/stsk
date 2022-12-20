<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-6">
        <h1 class="text-2xl text-center font-semibold bg-blue-100 mx-6 my-6 py-2 text-blue-700 rounded">課題の新規登録</h1>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('tasks.store') }}" method="POST" class="relative px-6 pb-6 flex-auto">

            @csrf

            <div class="mb-4 mr-10 float-left">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    イベントを選択
                </label>
                <select class="text-sm rounded" name="event_id" id="event">
                    <option value="" hidden>選択してください</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" @if (old('event_id') == $event->id) selected @endif>
                            {{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    教科を選択
                </label>
                <select class="text-sm rounded" name="subject_id" id="subject_te">
                    <option value="" hidden>選択してください</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @if (old('subject_id') == $subject->id) selected @endif>
                            {{ $subject->subject_text }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4 leading-relaxed">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    タイトルを入力
                </label>
                <input type="text" name="title" id="title" placeholder="{{ __('Event Name') }}"
                    value="{{ old('title') }}" required
                    class="placeholder-gray-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-3 leading-relaxed">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="body">
                    メモを入力
                </label>
                <textarea name="body" id="body" placeholder="メモ"
                    class="placeholder-gray-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32">{{ old('body') }}</textarea>
            </div>

            {{-- <div class="mb-4 mr-10  w-[100px]">
                <label class="block text-blue-700 text-sm font-bold mb-2" for="body">
                    ページ数を登録
                </label>
                <input type="text" name="total_page" id="total_page" placeholder="ページ数"
                    value="{{ old('total_page') }}" class="placeholder-gray-400">
            </div> --}}

            {{-- <div class="mb-4 mr-10">
                <label class="block text-blue-700 text-sm font-bold mb-2" for="body">
                    1pあたりの所要時間を登録
                </label>
                <input type="text" name="page_time" id="page_time" placeholder="1pあたりの所要時間"
                    value="{{ old('page_time') }}" class="placeholder-gray-400">
            </div> --}}

            <div class="mb-4 mr-10 float-left">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    ページ数を登録
                </label>
                <select class="text-sm rounded" name="total_page">
                    <option value="" hidden>選択してください</option>
                    <?php //PHPで動的に選択肢を追加
                    for ($i = 1; $i <= 50; $i++) {
                        echo '<option value = "' . $i . '">' . $i . ' ページ' . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                    1pあたりの所要時間を登録
                </label>
                <select class="text-sm rounded" name="page_time">
                    <option value="" hidden>選択してください</option>
                    <?php //PHPで動的に選択肢を追加
                    for ($j = 5; $j <= 120; $j = $j + 5) {
                        echo '<option value = "' . $j . '">' . $j . ' 分' . '</option>';
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="登録"
                class="mt-2 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
