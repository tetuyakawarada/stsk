<x-app-layout>
    <div class="shadow bg-white border rounded w-full max-w-md mx-auto mt-6">
        <h1 class="text-2xl text-center font-semibold bg-blue-100 mx-6 my-6 py-2 text-blue-700 rounded">進捗の登録</h1>

        <x-validation-errors :errors="$errors" />


        <form action="/tasks/progress/{{ $task->id }}" method="POST" class="relative px-6 pb-6 flex-auto">

            @csrf
            @method('PATCH')

            <div>
                <div class="bg-blue-500 text-white font-bold rounded px-2 mr-2 float-left">
                    {{ $task->subject->subject_text }}
                </div>
                <div class="font-bold">{{ $task->title }}</div>
            </div>

            <div class="mt-3 mb-6 px-3 py-2 w-full rounded bg-blue-100">
                {!! nl2br(e($task->body)) !!}
            </div>


            <div class="flex my-4">
                <div>予定の時間：</div>
                <div class="bg-gray-200 w-[50px] text-center rounded">{{ $task->total_page }} p</div>
                <div class="w-[20px] text-center">×</div>
                <div class="bg-gray-200 w-[60px] text-center rounded">{{ $task->page_time }} 分</div>
                <div class="w-[20px] text-center">=</div>
                <div class="bg-gray-200 w-[70px] text-center rounded">{{ $task->total_time }} 分</div>
            </div>

            <div class="flex my-4">
                <div>進んだ時間：</div>
                <div class="bg-gray-200 w-[50px] text-center rounded">{{ $task->finish_page }} p</div>
                <div class="w-[20px] text-center">×</div>
                <div class="bg-gray-200 w-[60px] text-center rounded">{{ $task->page_time }} 分</div>
                <div class="w-[20px] text-center">=</div>
                <div class="bg-gray-200 w-[70px] text-center rounded">{{ $task->progress_time }} 分</div>
            </div>

            <div class="flex my-4">
                <div>残りの時間：</div>
                <div class="bg-gray-200 w-[50px] text-center rounded">{{ $task->remaining_page }} p</div>
                <div class="w-[20px] text-center">×</div>
                <div class="bg-gray-200 w-[60px] text-center rounded">{{ $task->page_time }} 分</div>
                <div class="w-[20px] text-center">=</div>
                <div class="bg-gray-200 w-[70px] text-center rounded">{{ $task->remaining_time }} 分</div>
            </div>


            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mt-5 mb-1" for="body">
                    進んだページ数を登録
                </label>
                <input type="text" name="finish_page" id="finish_page" placeholder="ページ数"
                    value="{{ old('title', $task->finish_page) }}">
            </div> --}}

            <div class="flex mt-6 mb-4">

                <div class="mr-10">
                    <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                        進んだページ数を登録
                    </label>
                    <select class="text-sm rounded" name="finish_page">
                        <option value="{{ $task->finish_page }}" hidden>{{ old('title', $task->finish_page) }} ページ
                        </option>
                        <?php //PHPで動的に選択肢を追加
                        for ($i = 0; $i <= $task->total_page; $i++) {
                            echo '<option value = "' . $i . '">' . $i . ' ページ' . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="">
                    <label class="block text-blue-700 text-sm font-bold mb-1" for="title">
                        進捗状況を選択
                    </label>
                    <select class="text-sm rounded" name="state_id" id="state_te">
                        <option value="" hidden>選択してください</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if (old('state_id', $task->state->id) == $state->id) selected @endif>
                                {{ $state->state_text }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- <div>
                <label class="block text-gray-700 text-sm font-bold mt-5 mb-2" for="body">
                    進捗状況を選択
                </label>
                @foreach ($states as $state)
                    <label>
                        <input type="radio" name="state_id" id='state_text'
                            value="{{ $state->id }}"{{ old('state_id', $task->state->id) == $state->id ? 'checked' : '' }}>{{ $state->state_text }}
                    </label>
                @endforeach
            </div> --}}



            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>

    </div>
</x-app-layout>
