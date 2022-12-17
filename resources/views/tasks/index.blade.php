<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="css/index_style.css">


    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="font-sans antialiased">
    <x-jet-banner />



    <header>
        <div class="contener">
            <div class="header-logo">STSK!</div>
            <div class="header-logo-text">スタスク</div>

            <!-- Settings Dropdown -->
            <div class="header-right">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('tasks.create') }}">
                            {{ __('Create') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>
    </header>



    <div class="top">
        <div class="contener">
            <div class="user-info">{{ Auth::user()->name }} <span>さん</span></div>

            <div class="top-info event-info">
                <div class="top-info-title event-info-title">イベント情報</div>
                <div class="event-info-text">{{ $event->event_name }}</div>
                <div class="event-info-text">{{ $event->start_date }} から {{ $event->end_date }}</div>
                <div class="event-info-text">残り<span>{{ $event->end_day }}</span>day!!</div>
                <div class="flex justify-center items-center">
                    <a class="btn btn-event-info" href="{{ route('events.create') }}">新規登録</a>
                    <a class="btn btn-event-info" href="/events/{{ $event->id }}/edit">編集</a>
                </div>
            </div>

            <div class="top-info progress-info">
                <div class="top-info-title progress-info-title">進行状況</div>
                <div class="">
                    <div class="progress-info-text">{{ intval($progress_time) }} 時間 / {{ intval($total_time) }} 時間
                    </div>
                    <div class="progress-info-par">{{ intval($total_progress_degree) }}%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="tasks">
        <div class="contener">
            <div>
                <h1>課題一覧</h1>
                <a class="btn" href="{{ route('tasks.create') }}">新規課題の登録</a>
            </div>

            <div>
                <table border="1" style="padding: 5px 10px 20px 30px;" class="tasks-table">
                    <thead class="tasks-table-head">
                        <tr class="" align="left"　>
                            <th class="table-padding">イベント名</th>
                            <th class="table-padding">教科</th>
                            <th class="table-padding">課題名</th>
                            <th class="table-padding">必要時間</th>
                            <th class="table-padding">経過時間</th>
                            <th class="table-padding">進行度</th>
                            <th class="table-padding">進捗状況</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr align="left" class="tasks-table-body">
                                <td width="160px" class="table-padding">{{ $task->event->event_name }}</td>
                                <td width="100px" class="table-padding">{{ $task->subject->subject_text }}</td>
                                <td width="160px" class="table-padding">{{ $task->title }}</td>
                                <td width="100px" class="table-padding">{{ $task->total_time }} 分</td>
                                <td width="100px" class="table-padding">{{ $task->progress_time }} 分</td>
                                <td width="100px" class="table-padding">{{ $task->degree_time }} %</td>
                                <td width="100px" class="table-padding">{{ $task->state->state_text }}</td>

                                <td width="80px">
                                    <a href="{{ route('tasks.show', $task) }}" class="btn tasks-btn-show">
                                        {{ __('Details') }}
                                    </a>
                                </td>

                                <td width="80px">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn tasks-btn-show">
                                        {{ __('Edit') }}
                                    </a>
                                </td>

                                <td width="80px"><a href="/tasks/progress/{{ $task->id }}/edit"
                                        class="btn tasks-btn-show">
                                        {{ __('進捗') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>

    </footer>












    <div class="xxx"></div>







    <div class="bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex my-5">
                {{-- タイトル・イメージ --}}
                <div
                    class="relative text-center float-light w-[600px] h-[220px] container border border-gray-400 bg-gray-200">
                    <img class="absolute w-[600px] h-[220px]" src="/images/img_stady.jpg">
                    <div class="absolute text-4xl mt-5 ml-5 text-white font-bold">{{ Auth::user()->name }} さん</div>
                </div>
                {{-- イベント情報 --}}
                <div class="ml-4 ">
                    <div class="bg-amber-500 text-center text-white w-[300px] h-[36px] py-2 font-bold">イベント情報</div>
                    <div class="text-center float-light h-[184px] container border-2 border-amber-500 bg-amber-100">
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
                    <div class="bg-fuchsia-500 text-center text-white w-[300px] h-[36px] py-2 font-bold">進行状況</div>

                    <div
                        class="text-center float-light w-[300px] h-[184px] container px-4 border-2 border-fuchsia-500 bg-fuchsia-100">
                        <div class="mt-5 text-2xl font-bold text-fuchsia-500">{{ intval($progress_time) }} 時間 /
                            {{ intval($total_time) }} 時間</div>
                        <div class="flex justify-center items-center text-bottom">
                            <div class="mt-4 text-8xl font-bold text-fuchsia-500">
                                {{ intval($total_progress_degree) }}
                            </div>
                            <div class="mt-6 text-6xl font-bold text-fuchsia-500">%</div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- 課題 一覧 --}}
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
                                {{-- <td class="py-2 px-6">{{ intval($task->degree_time) }} %</td> --}}
                                <td class="py-2 px-6">{{ $task->degree_time }} %</td>
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
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
