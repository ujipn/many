<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>団体さんいらっしゃい</title>
     <!-- Bootstrap CSS -->
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var asset_id = {{ $asset->id }};
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        height: 'auto',
        firstDay: 1,
        headerToolbar: {
            left: "dayGridMonth,listMonth",
            center: "title",
            right: "today prev,next",
        },
        buttonText: {
            today: '今月',
            month: '月',
            list: 'リスト',
        },
        noEventsContent: '案件はありません',
        eventSources: [ 
            {
                url: '/get_events/'+ asset_id, // getEventsメソッドからイベントを取得
                method: 'GET',
                failure: function() {
                    alert('カレンダーのイベントを取得できませんでした。');
                },
            },
        ],
        
        eventContent: function(arg) {
           
        var reserveNumber = arg.event.extendedProps.reserve_number;
            //argは関数の引数を表し、ここではFullCalendarから提供されるイベントオブジェクトを参照しています。
            //eventはargオブジェクトのプロパティで、現在のイベントを表します。
            //extendedPropsはeventオブジェクトのプロパティで、カスタムプロパティ（PHPのサーバーサイドコードで設定した追加のイベントデータ）を含みます。
            //つまり、現在のイベントの予約数を取得することを表しています。
        var Id = arg.event.extendedProps.calendarId;
        var title = arg.event.title;
        var createdTime = arg.event.extendedProps.created_at;
        var url = arg.event.url;

        if (arg.view.type === 'listMonth') {
        return {
            html: '<a href="' + url + '"> (募集番号: ' + Id + ')' + title + ' (募集人数: ' + reserveNumber + ')' + ' (登録時間: ' + createdTime + ')</a>',
        };
    } else {
        return {
            html: '<a href="' + url + '">' + title + '</a>',
        };
    }
    },
        
    });
    calendar.render();
 });
    </script>
</head>

<body >
   
    <div id='calendar' ></div> <!-- カレンダーを右半分に配置 -->
</body>

</html>