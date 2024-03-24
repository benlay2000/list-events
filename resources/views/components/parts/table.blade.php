@php
    $tableContents = [
        'type' => 'table',
        'title' => '企業情報',
        'text' => '主な会社の情報は下記のとおりです。',
        'table' => [
            [
                'title' => '会社名',
                'content' => '合同会社deuxh',
            ],
            [
                'title' => '代表者',
                'content' => '山田太郎',
            ],
            [
                'title' => '所在地',
                'content' => '東京都葛飾区',
            ],
        ],
    ];
@endphp

<section class="table">
    <div class="py-24 flex flex-col gap-10 container">
        <header class="text-center flex flex-col gap-2">
            <h1 class="font-bold text-2xl">{{ $tableContents['title'] }}</h1>
            <p>
                {{ $tableContents['text'] }}
            </p>
        </header>

        <section class="content flex flex-col gap-2">
            @foreach ($tableContents['table'] as $table)
                <div class="flex border-b last:border-none px-2 py-1">
                    <section class="th w-36 shrink-0 grow-0">{{ $table['title'] }}</section>
                    <section class="table-content grow">{{ $table['content'] }}</section>
                </div>
            @endforeach
        </section>
    </div>
</section>
