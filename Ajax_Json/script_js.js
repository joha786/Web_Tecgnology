function loadData() {
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "data.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            var html = '<br><br>' +
                '<table border="2" cellpadding="8" cellspacing="2">' +
                '  <tr>' +
                '    <th>Name</th>' +
                '    <th>Age</th>' +
                '    <th>City</th>' +
                '  </tr>';

            if (Array.isArray(data)) {
                data.forEach(function(item) {
                    html += '  <tr>' +
                        '    <td>' + item.name + '</td>' +
                        '    <td>' + item.age + '</td>' +
                        '    <td>' + item.city + '</td>' +
                        '  </tr>';
                });
            } else {
                html += '  <tr>' +
                    '    <td>' + data.name + '</td>' +
                    '    <td>' + data.age + '</td>' +
                    '    <td>' + data.city + '</td>' +
                    '  </tr>';
            }

            html += '</table>';
            document.getElementById("result").innerHTML = html;
        }
    };

    xhr.send();
}