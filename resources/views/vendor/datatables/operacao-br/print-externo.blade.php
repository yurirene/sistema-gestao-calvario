<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print Table</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            body {margin: 20px}
        </style>
    </head>
    <body>
        <table class="table table-bordered table-condensed table-striped">
            @foreach($data as $banco => $rows)
                @if ($loop->first)
                    <tr>
                        @foreach($rows[0] as $key => $value)
                            <th>{!! $key !!}</th>
                        @endforeach
                    </tr>
                @endif
                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $key => $value)
                            @if(is_string($value) || is_numeric($value))
                                <td>{!! $value !!}</td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                @if (!$loop->last)
                <tr style="height: 30px;"></tr>
                @endif
            @endforeach
            <tr>
                <td colspan="8"></td> 
                <td class="text-right">Total: R$ <b>{{$totalizadores['total_real']}}</b></td>
            </tr>
        </table>
    </body>
</html>
