@php
    $cards = [
        [
            'title' => '簡単',
            'text' => '驚くほど簡単にホームページを作成できます。',
        ],
        [
            'title' => '安価',
            'text' => 'ワンコインでホームページを公開できます。',
        ],
        [
            'title' => '高品質',
            'text' => '高品質なホームページを作成できます。',
        ],
    ];
@endphp

<section class="cards">
    <div class="flex flex-col gap-10 container py-24">
        <header class="text-center flex flex-col gap-2">
            <h1 class="text-2xl font-bold">elvyta 3つの特徴</h1>
            <p>elvytaには以下のような特徴があります。</p>
        </header>

        <ul class="flex gap-10">
            @foreach ($cards as $card)
                <li class="flex flex-col gap-3 h-full w-1/3">
                    <section class="image h-48 bg-gray-500 bg-cover">
                    </section>

                    <section class="text mt-auto">
                        <h1 class="font-bold">{{ $card['title'] }}</h1>
                        <p>{{ $card['text'] }}</p>
                    </section>
                </li>
            @endforeach
        </ul>
    </div>
</section>
