<x-app-layout>
    <div class="mt-10">
        <h1 class="text-left text-lg">課題一覧</h1>

        <div class="py-4 px-6"><a href="{{ route('tasks.create') }}"
                class="inline-block bg-green-500 hover:bg-green-700 text-center text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-15">
                新規課題の登録
            </a>
        </div>


        <table class="w-full text-sm text-left text-gray-0 mt-3">
            <thead class="text-xs text-white uppercase bg-emerald-600">
                <tr>
                    {{-- <th scope="col" class="py-3 px-6">e-id</th> --}}
                    {{-- 要確認 --}}
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
                        {{-- <td class="py-4 px-6">{{ $task->event->event_name }}</td> --}}
                        {{-- 要確認 --}}
                        <td class="py-4 px-6">{{ $task->subject->subject_text }}</td>
                        <td class="py-4 px-6">{{ $task->title }}</td>
                        <td class="py-4 px-6">{{ $task->total_page }}p×{{ $task->page_time }}分</td>
                        <td class="py-4 px-6">{{ $task->finish_page }}p×{{ $task->page_time }}分</td>
                        <td class="py-4 px-6">⚫⚫%</td>
                        <td class="py-4 px-6">{{ $task->state->state_text }}</td>
                        <td class="py-4 px-6">
                            <a href="{{ route('tasks.show', $task) }}"
                                class="inline-block bg-blue-500 hover:bg-blue-700 text-center text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-15">
                                {{ __('Details') }}
                            </a>
                        </td>
                        <td class="py-4 px-6"><a href="{{ route('tasks.edit', $task) }}"
                                class="inline-block bg-green-500 hover:bg-green-700 text-center text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-15">
                                {{ __('Edit') }}
                            </a>
                        </td>
                        <td class="py-4 px-6"><a href=""
                                class="inline-block bg-red-500 hover:bg-red-700 text-center text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-30">
                                {{ __('進捗を登録') }}
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
