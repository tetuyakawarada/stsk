<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-10">
        <h1 class="text-3xl text-center font-semibold p-6">イベントの編集</h1>

        <x-validation-errors :errors="$errors" />

        {{-- <form action="{{ route('events.update', $event) }}" method="POST" class="relative px-6 pb-6 flex-auto"> --}}
        <form action="/events/{{ $event->id }}" method="POST" class="relative px-6 pb-6 flex-auto">

            @csrf
            @method('PATCH')

            <div class="my-4 text-slate-500 text-lg leading-relaxed">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    イベント名を入力
                </label>
                <input type="text" name="event_name" id="event_name" placeholder="{{ __('イベント名') }}"
                    value="{{ old('event_name', $event->event_name) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                    開始日を入力
                </label>
                <input type="date" name="start_date" id="start_date"
                    value="{{ old('start_date', $event->start_date) }}" required
                    class="shadow appearance-none border rounded w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="body">
                    最終日を入力
                </label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date) }}"
                    required
                    class="shadow appearance-none border rounded w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-6 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
