<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-10">
        <h1 class="text-3xl text-center font-semibold p-6">課題の新規登録</h1>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('tasks.store') }}" method="POST" class="relative px-6 pb-6 flex-auto">

            @csrf

            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                イベントを選択
            </label>
            <div>
                @foreach ($events as $event)
                    <label>
                        <input type="radio" name="event_id" id='event'
                            value="{{ $event->id }}"{{ old('event_id') == $event->id ? 'checked' : '' }}>{{ $event->event_name }}
                    </label>
                @endforeach
            </div>

            <br>

            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                教科を選択
            </label>
            <div>
                @foreach ($subjects as $subject)
                    <label>
                        <input type="radio" name="subject_id" id='subject_te'
                            value="{{ $subject->id }}"{{ old('subject_id') == $subject->id ? 'checked' : '' }}>{{ $subject->subject_text }}
                    </label>
                @endforeach
            </div>

            <div class="my-4 text-slate-500 text-lg leading-relaxed">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    タイトルを入力
                </label>
                <input type="text" name="title" id="title" placeholder="{{ __('Event Name') }}" value=""
                    required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="my-4 text-slate-500 text-lg leading-relaxed mb-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    メモを入力
                </label>
                <textarea name="body" id="body"
                    placeholder="メモ"class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline h-32"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    ページ数を登録
                </label>
                <input type="text" name="total_page" id="total_page" placeholder="ページ数" value="">
            </div>

            <br>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    1pあたりの所要時間を登録
                </label>
                <input type="text" name="page_time" id="page_time" placeholder="1pあたりの所要時間" value="">
            </div>

            <br>

            <input type="submit" value="登録"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
