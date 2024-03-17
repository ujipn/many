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
        noEventsContent: '募集はありません',
        eventSources: [ 
            {
                url: '/get_events/'+  {{ $asset->id }}, // getEventsメソッドからイベントを取得
                method: 'GET',
                failure: function() {
                    alert('カレンダーのイベントを取得できませんでした。');
                },
            },
        ],
        
        eventContent: function(arg) {
                    var htmlContent = '<a href="' + arg.event.url + '">' + arg.event.title + '</a>';
                    if (arg.view.type === 'listMonth') {
                        htmlContent = '<a href="' + arg.event.url + '"> (募集番号: ' + arg.event.extendedProps.calendarId + ')' + arg.event.title + ' (募集人数: ' + arg.event.extendedProps.reserve_number + ')' + ' (登録時間: ' + arg.event.extendedProps.created_at + ')</a>';
                    }
                    return { html: htmlContent };
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