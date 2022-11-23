<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @foreach($transactions as $transaction)
        @if ($transaction->status == 1)
         Hello {{ $transaction->name }}, your book request is APPROVED and ready on {{ $transaction->date_available }}  .
        @else
         Hello {{ $transaction->name }}, your book request is DECLINED .
        @endif

    @endforeach
</body>
</html>
