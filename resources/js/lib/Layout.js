export default class Layout {
    cover() {
        return {
            type: "cover",
            heading: "elvytaで簡単に始めるホームページ作成",
            text: "手間なくホームページを作れるので、本来やるべき仕事に時間を使えます。",
            buttonText: "お問い合わせはこちら",
            link: "https://yahoo.co.jp",
            backgroundImage:
                "https://images.unsplash.com/photo-1681068420510-cb528c65d595?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1931&q=80",
        };
    }

    longText() {
        return {
            type: "long-text",
            heading: "HPを作る時間って無駄じゃないですか？",
            text: "限られた時間の中で事業を成長させるには、本来やるべきことに集中する必要があります。elvytaを使えば、HPにかかる時間を大幅に削減できるので、事業に集中できます。",
            backgroundImage: "",
        };
    }

    cards() {
        return {
            type: "cards",
            heading: "elvyta 3つの特徴",
            text: "elvytaには以下のような特徴があります。",
            cardList: [
                {
                    image: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80",
                    title: "簡単",
                    text: "驚くほど簡単にHPを作れます",
                },
                {
                    image: "",
                    title: "スマホ対応",
                    text: "ただ作るだけでPC用途スマホ用のページが出来上がります",
                },
                {
                    image: "",
                    title: "低コスト",
                    text: "葛飾区の事業者向けに低コストで提供しています",
                },
            ],
        };
    }

    hero() {
        return {
            type: "hero",
            image: "https://images.unsplash.com/photo-1595064085577-7c2ef98ec311?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1364&q=80",
            heading: "事業のPRをサクッと",
            text: "会社の魅力を伝えるHPを短時間で簡単に作成可能",
            buttonText: "今すぐお問い合わせ",
            link: "https://elvyta.com",
        };
    }

    list() {
        return {
            type: "list",
            heading: "elvyta 3つの特徴",
            text: "elvytaには以下のような特徴があります。",
            list: [
                {
                    image: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80",
                    title: "簡単",
                    text: "驚くほど簡単にHPを作れます",
                },
                {
                    image: "",
                    title: "スマホ対応",
                    text: "ただ作るだけでPC用途スマホ用のページが出来上がります",
                },
                {
                    image: "",
                    title: "低コスト",
                    text: "葛飾区の事業者向けに低コストで提供しています",
                },
            ],
        };
    }

    table() {
        return {
            type: "table",
            title: "テーブル",
            text: "情報をテーブル表示することができます。",
            table: [
                {
                    title: "タイトル1",
                    content: "コンテンツ1",
                },
            ],
        };
    }

    snsButtons() {
        //
    }
}
