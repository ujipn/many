<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>団体さんいらっしゃい</title>
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
            right: "today prev,next"
        },
        buttonText: {
            today: '今月',
            month: '月',
            list: 'リスト'
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
        eventMouseEnter(info) { 
            $(info.el).popover({
                title: info.event.title,
                content: info.event.extendedProps.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body',
                html: true
            });
        }
    });
    calendar.render();
});
    </script>
</head>

<body >
   
    <div id='calendar' ></div> <!-- カレンダーを右半分に配置 -->
</body>

</html>