<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fish Budget</title>
</head>
<body>
    <table>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{$transaction->type}}</td>
                <td>{{$transaction->description}}</td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->date}}</td>
            </tr>
        @endforeach
    </table>    
</body>
</html>