@php
    $listItems = [
        'type' => 'list',
        'heading' => 'elvyta 3つの特徴',
        'text' => 'elvytaには以下のような特徴があります。',
        'list' => [
            [
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80',
                'title' => '簡単',
                'text' => '驚くほど簡単にHPを作れます',
            ],
            [
                'image' => '',
                'title' => 'スマホ対応',
                'text' => 'ただ作るだけでPC用途スマホ用のページが出来上がります',
            ],
            [
                'image' => '',
                'title' => '低コスト',
                'text' => '葛飾区の事業者向けに低コストで提供しています',
            ],
        ],
    ];
@endphp

<section class="list">
    <div class="py-24 container flex flex-col gap-12">
        <header class="text-center flex flex-col gap-2">
            <h1 class="font-bold text-2xl">{{ $listItems['heading'] }}</h1>
            <p>{{ $listItems['text'] }}</p>
        </header>
        <ul class="flex flex-col gap-8">
            @foreach ($listItems['list'] as $item)
                <li v-for="item in content.list">
                    <div class="flex gap-4">
                        <div class="image w-2/6 aspect-[4/3] bg-cover bg-gray-400 bg-center"
                            style="background-image: url({{ $item['image'] }})"></div>
                        <div class="p-4 w-4/6 flex flex-col justify-center">
                            <h1 class="font-bold">{{ $item['title'] }}</h1>
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
