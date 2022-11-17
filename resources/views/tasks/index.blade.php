<x-app-layout>
    <div class="flex my-5">
        {{-- タイトル・イメージ --}}


        <div class="relative text-center float-light w-[600px] h-[220px] container border border-gray-400 bg-gray-200">
            <img class="absolute w-[600px] h-[220px]" src="/images/img_stady.jpg">
            <div class="absolute text-4xl mt-5 ml-5 text-white font-bold">{{ Auth::user()->name }} さん</div>
        </div>
        {{-- イベント情報 --}}
        <div class="ml-4 ">
            <div class="bg-amber-500 text-center text-white w-[300px] h-[36px] py-2 font-bold rounded">イベント情報</div>
            <div class="text-center float-light h-[184px] container border-2 border-amber-500 bg-amber-100 rounded">
                <div class="mt-5">{{ $event->event_name }}</div>
                <div>{{ $event->start_date }} から {{ $event->end_date }}</div>
                <div class="flex justify-center items-center">
                    <div>残り </div>
                    <div class="text-6xl">{{ $event->end_day }}</div>
                    <div> day!!</div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="px-3"><a href="{{ route('events.create') }}"
                            class="inline-block bg-green-500 hover:bg-green-700 text-center text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline w-15">
                            新規登録
                        </a>
                    </div>
                    <div class=""><a href="/events/{{ $event->id }}/edit"
                            class="inline-block bg-amber-500 hover:bg-amber-700 text-center text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-15">
                            編集
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- 進行状況 --}}
        <div class="ml-4 ">
            <div class="bg-fuchsia-500 text-center text-white w-[300px] h-[36px] py-2 font-bold rounded">イベント情報</div>

            <div
                class="text-center float-light w-[300px] h-[184px] container px-4 border-2 border-fuchsia-500 bg-fuchsia-100 rounded">
                <div class="mt-5">進行状況</div>
                <div class="mt-1">{{ intval($progress_time) }} 時間 / {{ intval($total_time) }} 時間</div>
                <div class="mt-6 text-7xl">{{ intval($total_progress_degree) }} %</div>
            </div>
        </div>
    </div>

    {{-- 課題一覧 --}}
    <div class="mt-0">
        <div class="flex">
            <h1 class="py-3 px-3 text-left text-lg">課題一覧</h1>
            <div class="py-2 px-3"><a href="{{ route('tasks.create') }}"
                    class="inline-block bg-green-500 hover:bg-green-700 text-center text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline w-15">
                    新規課題の登録
                </a>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-0 mt-3">
            <thead class="text-xs text-white uppercase bg-emerald-600">
                <tr>
                    <th scope="col" class="py-3 px-6">イベント名</th>
                    <th scope="col" class="py-3 px-6">教科</th>
                    <th scope="col" class="py-3 px-6">課題名</th>
                    <th scope="col" class="py-3 px-6">必要時間</th>
                    <th scope="col" class="py-3 px-6">経過時間</th>
                    <th scope="col" class="py-3 px-6">進行度</th>
                    <th scope="col" class="py-3 px-6">進捗状況</th>
                    <th scope="col" class="py-3 px-6"></th>
                    <th scope="col" class="py-3 px-6"></th>
                    <th scope="col" class="py-3 px-6"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="bg-emerald-100 border-b">
                        <td class="py-2 px-6">{{ $task->event->event_name }}</td>
                        <td class="py-2 px-6">{{ $task->subject->subject_text }}</td>
                        <td class="py-2 px-6">{{ $task->title }}</td>
                        <td class="py-2 px-6">{{ $task->total_time }} 分</td>
                        <td class="py-2 px-6">{{ $task->progress_time }} 分</td>
                        <td class="py-2 px-6">{{ intval($task->degree_time) }} %</td>
                        <td class="py-2 px-6">{{ $task->state->state_text }}</td>
                        <td class="py-2 px-6">
                            <a href="{{ route('tasks.show', $task) }}"
                                class="inline-block bg-blue-500 hover:bg-blue-700 text-center text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-15">
                                {{ __('Details') }}
                            </a>
                        </td>
                        <td class="py-2 px-6"><a href="{{ route('tasks.edit', $task) }}"
                                class="inline-block bg-green-500 hover:bg-green-700 text-center text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-15">
                                {{ __('Edit') }}
                            </a>
                        </td>
                        <td class="py-2 px-6"><a href="/tasks/progress/{{ $task->id }}/edit"
                                class="inline-block bg-red-500 hover:bg-red-700 text-center text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-30">
                                {{ __('進捗を登録') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
