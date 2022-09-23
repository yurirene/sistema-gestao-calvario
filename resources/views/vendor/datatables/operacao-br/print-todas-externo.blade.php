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
            <tr>
                @foreach($cabecalho as $value)
                    <th>{!! $value !!}</th>
                @endforeach
            </tr>

            @php
                $total = 0;    
            @endphp
            @foreach($dados as $banco => $rows)
                @foreach($rows['operacoes'] as $row)
                @php $total += floatval($row[5]) @endphp
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
                <tr>
                    <td colspan="12">
                        Total Banco {{ $banco }}: R$ <b>{{ number_format($dados[$banco]['total_banco'], 2, ',', '.') }}</b>
                    </td>
                </tr>
                @if (!$loop->last)
                <tr style="height: 30px;"></tr>
                @endif
            @endforeach
            <tr>
                <td  colspan="12" class="text-right">Total: R$ <b>{{ number_format($total, 2, ',', '.') }}</b></td>
            </tr>
        </table>
    </body>
    <script>
        window.print()
    </script>
</html>
