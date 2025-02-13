<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выдаватель бана хакеру ИНАТОР</title>
    <style>
        body {
            display: flex;
            flex-direction: column; /* Размещение элементов вертикально */
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Занимает всю высоту экрана */
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            position: relative;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            margin-bottom: 20px; /* Отступ между контейнером и магазином */
        }
        .clicker {
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .image {
            width: 150px;
            height: 150px;
            cursor: pointer;
            border-radius: 50%;
            transition: transform 0.1s, box-shadow 0.1s;
            border: 5px solid rgba(255, 255, 255, 0.2);
        }
        .image:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
        }
        .image:active {
            transform: scale(0.95);
        }
        .reset-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .reset-button:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .visitor-counter {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Стили для магазина */
        .shop {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
            width: 80%; /* Занимает 80% ширины экрана */
            max-width: 600px; /* Максимальная ширина магазина */
        }
        .shop-title {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .shop-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .shop-item button {
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .shop-item button:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .achievement {
            margin-top: 10px;
            font-style: italic;
            color: #ffeb3b; /* Желтый цвет для сообщений */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="clicker">Количество дней бана: <span id="count">0</span></div>
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAYAAAA5ZDbSAAAAAXNSR0IArs4c6QAABG1JREFUeF7tnb1rU1EAxRNKqsa2BEkHqYigDu0kODhV8B9wLujs4iJuri7dxMVBZ4cuOjh1E+wgDoJTHVQQMRRqkFAapDhEQmhsPkzOPbel3ptf53Py7vude9699/Wr+HRxsVUwvqq7u4arYzlZKtnetnFrairKH2I+0bLwdC9R3tsLudyAtj4zE+UvEvBofgRszC8arEOjwTorS0mDDWw0WIdGg3VWlpIGG9hosA6NBuusLCUNNrDRYB0aDdZZWUoabGCjwTo0GqyzspQ02MBGg3VoNFhnZSkntsF3NjctYJjCCDxbWgoz9Knt7yYRcBR32UzAMqo0hQScZm7yqAlYRpWmkIDTzE0eNQHLqNIUEnCaucmjJmAZVZpCAk4zN3nUBCyjSlNIwGnmJo+agGVUaQoJOM3c5FETsIwqTSEBp5mbPGoCllGlKYwOuNWK/P3INLlNzKiLBJx31gScd74FAibgzAlkfns0mIAzJ5D57dFgAs6cQOa3R4MJOHMCmd8eDSbgzAlkfns0mIAzJ5D57dFgAh5OYDfizwnv7OxEYa1UKlH+6elp2b+9vS1rhwljx1oul6OubzeYgDXuBKxx6lHFQqPBAnQaLEAqFAqxk5FHtMa5R0WDBWg0WIBEgzVI/arYxx4NFrjTYAESDdYg0WCPU9vFOXgMO150GJOLN1k6NI5JOquukk2WAI1NlgCJTZYGiU2Wx4lNlsCNTZYAqV/CJkuHxiZLZzWZm6xarWb9g9y5uTkDbccyOztre9vGZrMZ5Q/ZRZci/9dx7FgbjUbUvRYJeDQ/AjbmFw3WodFgnZW1BtNgAzAN1qHRYJ0VDQ5hxS5ao8UuWuPUo4qFxjFJgE6DBUiHcGZnDdY496hosACNBguQaLAGqV/FGqxz41XlGFa86NAnU1fJiw4d2rFtshYWFoaOsl6v66M/oHx8/oPle7j+I9j36+pN2bM6/1bWHhTe+3bF8lWr1R5frVazPmffZD+iCXg0dwLu40ODO0BocN/E4BE9+knCI3rMCsca3AeITVYHCGswa/DQZwdrMGtw0LGJNZg1eDgBzsGcg4MeJZyDOQcPnTCcgzkHDxDgXbTwcGUNznwNPvvlzdA7LC6vCNNjUPL89G/Ld2v9RbAvpMEv50vBn9823G56vtbGWs/1ti5et66/b7KPSQQ8mvt/E3ChULB+u/Da6mt7ZlV/fre9bWNj40mUP8RcWb4bIh/Q1s+ci/K/e3Ajyl8k4NH8CNiYXzRYh0aDdVaWkgYb2GiwDo0G66wsJQ02sNFgHRoN1llZShpsYKPBOjQarLOylDTYwEaDdWg0WGdlKWmwgY0G69BosM7KUtJgAxsN1qHRYJ2VpaTBBjYarEOLbnCz2bS+4a8PcVB56v2rGHtS3pAfDzqKGysS8FFg/fuZExnw4uVLUVS/rj2K8oeYL6zcD5EPaD9++hzljzUfS4MJODY23U/AY1jRYH0ydZU02IBmWmgwDTanzggbDT58pv/6RBqceYP/AMUfwqiKMpkzAAAAAElFTkSuQmCC" alt="Кликер" class="image" id="clicker-image">
        <button class="reset-button" id="reset-button">Сбросить</button>
        <div id="achievement-message" class="achievement"></div>
    </div>

    <!-- Магазин -->
    <div class="shop">
        <h2 class="shop-title">Магазин</h2>
        <div class="shop-item">
            <span>иванзолоТапалка: +10 дней бана/10 сек.</span>
            <button data-item="ivan">Купить (150)</button>
        </div>
        <div class="shop-item">
            <span>крiб: Умножает дни бана на 2/10 сек.</span>
            <button data-item="krib">Купить (200)</button>
        </div>
        <div class="shop-item">
            <span>клутоии: +100 дней бана/10 сек.</span>
            <button data-item="klutoi">Купить (400)</button>
        </div>
    </div>


    <!-- Счетчик посетителей -->
    <div class="visitor-counter">Посетителей: <span id="visitor-count">0</span></div>

    <script>
        // Счетчик кликов
        const countElement = document.getElementById('count');
const imageElement = document.getElementById('clicker-image');
        const resetButton = document.getElementById('reset-button');
        const achievementMessage = document.getElementById('achievement-message');
        const shopButtons = document.querySelectorAll('.shop-item button');

        let count = parseInt(localStorage.getItem('clickCount')) || 0;
        let clickValue = parseInt(localStorage.getItem('clickValue')) || 1; // Добавлено
        let banPerIntervalIvan = parseInt(localStorage.getItem('banPerIntervalIvan')) || 0;
        let banMultiplierKrib = parseFloat(localStorage.getItem('banMultiplierKrib')) || 1;
        let banPerIntervalKlutoi = parseInt(localStorage.getItem('banPerIntervalKlutoi')) || 0;

        countElement.textContent = count;

        const achievements = {
            100: "Достижение: 100 кликов!",
            200: "Достижение: 200 кликов!",
            300: "Достижение: 300 кликов!",
            400: "Достижение: 400 кликов!",
            500: "Достижение: 500 кликов!",
            600: "Достижение: 600 кликов!",
            700: "Достижение: 700 кликов!",
            800: "Достижение: 800 кликов!",
            900: "Достижение: 900 кликов!",
            1000: "Достижение: 1000 кликов! p.s Кто это читает Держите список лошар:qeiwoxi,angeldemon,создатель этого кликера "
        };

        function showAchievement(message) {
            achievementMessage.textContent = message;
            setTimeout(() => {
                achievementMessage.textContent = '';
            }, 3000);
        }

        imageElement.addEventListener('click', () => {
            count += clickValue;
            countElement.textContent = count;
            localStorage.setItem('clickCount', count);

            if (achievements[count]) {
                showAchievement(achievements[count]);
            }
        });

        resetButton.addEventListener('click', () => {
            count = 0;
            clickValue = 1;
            banPerIntervalIvan = 0;
            banMultiplierKrib = 1;
            banPerIntervalKlutoi = 0;
            countElement.textContent = count;
            localStorage.setItem('clickCount', count);
            localStorage.setItem('clickValue', clickValue);
            localStorage.setItem('banPerIntervalIvan', banPerIntervalIvan);
            localStorage.setItem('banMultiplierKrib', banMultiplierKrib);
            localStorage.setItem('banPerIntervalKlutoi', banPerIntervalKlutoi);
            achievementMessage.textContent = '';
        });

        // Магазин
        shopButtons.forEach(button => {
            button.addEventListener('click', () => {
                const item = button.dataset.item;
                let cost;

                switch (item) {
                    case 'ivan':
                        cost = 150;
                        if (count >= cost) {
                            count -= cost;
                            banPerIntervalIvan += 10;
                            countElement.textContent = count;
                            localStorage.setItem('clickCount', count);
                            localStorage.setItem('banPerIntervalIvan', banPerIntervalIvan);
                        } else {
                            alert('Недостаточно дней бана!');
                        }
                        break;
                    case 'krib':
                        cost = 200;
                        if (count >= cost) {
                            count -= cost;
                            banMultiplierKrib *= 2;
                            countElement.textContent = count;
                            localStorage.setItem('clickCount', count);
                            localStorage.setItem('banMultiplierKrib', banMultiplierKrib);
                        } else {
                            alert('Недостаточно дней бана!');
}
                        break;
                    case 'klutoi':
                        cost = 400;
                        if (count >= cost) {
                            count -= cost;
                            banPerIntervalKlutoi += 100;
                            countElement.textContent = count;
                            localStorage.setItem('clickCount', count);
                            localStorage.setItem('banPerIntervalKlutoi', banPerIntervalKlutoi);
                        } else {
                            alert('Недостаточно дней бана!');
                        }
                        break;
                }
            });
        });

        // Автоматический прирост бана
        setInterval(() => {
            let banIncrease = banPerIntervalIvan + banPerIntervalKlutoi;
            banIncrease *= banMultiplierKrib;

            count += banIncrease;
            countElement.textContent = count;
            localStorage.setItem('clickCount', count);
        }, 10000);


        // Счетчик посетителей
        const visitorCountElement = document.getElementById('visitor-count');

        // Генерация уникального идентификатора для посетителя
        function getVisitorId() {
            let visitorId = localStorage.getItem('visitorId');
            if (!visitorId) {
                visitorId = Math.random().toString(36).substring(2) + Date.now().toString(36);
                localStorage.setItem('visitorId', visitorId);
            }
            return visitorId;
        }

        // Имитация "серверного" хранения данных
        function updateVisitorCounter() {
            let visitors = JSON.parse(localStorage.getItem('visitors')) || [];
            const visitorId = getVisitorId();

            if (!visitors.includes(visitorId)) {
                visitors.push(visitorId);
                localStorage.setItem('visitors', JSON.stringify(visitors));
            }

            visitorCountElement.textContent = visitors.length;
        }

        // Инициализация счетчика
        updateVisitorCounter();

        // Первоначальное отображение значения счетчика
        countElement.textContent = count;
    </script>
</body>
</html>