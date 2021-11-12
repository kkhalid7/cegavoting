<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$vote->vote_id}}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
            border-collapse: collapse;
            border: 1px solid slategrey;
        }

        table td {
            border-right: 1px solid slategrey;
            border-left: 1px solid slategrey;
            border-bottom: 1px solid slategrey;
        }

        tfoot tr td {
            font-weight: normal;
            font-size: x-small;
        }

        tfoot tr {
            border-bottom: none;
        }

        tfoot td {
            border: 1px solid slategrey;
            padding: 7px;
        }

        .no-border-table {
            border: none;
        }

        .no-border-table tr td {
            border: none;
        }

        .gray {
            background-color: lightgray
        }

        .bold {
            font-weight: bold;
        }
    </style>

</head>
<body>
<table width="100%" class="no-border-table">
    <tr>
        <td valign="top">

        </td>
        <td valign="top">
            <h3>Vote ID File</h3>
        </td>
        <td valign="top">

        </td>
    </tr>
    <tr>
        <td>

        </td>
        <td>
            Vote ID : {{$vote->vote_id}}
        </td>
    </tr>

</table>

<table width="100%" class="no-border-table">
    <tr>
        <td>
          Recorded IP : {{$voter->ip_address}}
        </td>
    </tr>
    <tr>
        <td> Recorded Latitude {{!empty($voter->latitude)? $voter->latitude: ''}}</td>
    </tr>
    <tr>
        <td> Recorded  Latitude {{!empty($voter->longitude)? $voter->longitude: ''}}</td>
    </tr>

</table>

<br/>
</body>
</html>
