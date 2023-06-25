<?php

namespace App\DataTables;

use App\Models\TesourariaMovimento;
use App\Models\TesourariaMovimentos;
use App\Services\FrequenciaService;
use App\Services\TesourariaMovimentoService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TesourariaMovimentoDataTable extends DataTable
{
    public const TIPO = [
        'S' => TesourariaMovimento::SAIDA,
        'E' => TesourariaMovimento::ENTRADA
    ];
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($sql) {
                return view('area-tesouraria.movimentos.action', [
                    'route' => 'area-tesouraria.movimentos',
                    'id' => $sql->id,
                ]);
            })
            ->editColumn('descricao', function ($sql) {
                return $sql->descricao;
            })
            ->editColumn('valor', function ($sql) {
                return $sql->valor_formatado;
            })
            ->editColumn('tipo', function ($sql) {
                return TesourariaMovimentoService::LABELS[$sql->tipo];
            })
            ->editColumn('created_at', function ($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('membro', function ($sql) {
                return !is_null($sql->membro) ? $sql->membro->nome : '';
            })
            ->with('totalizadores', $this->totalizadores())
            ->rawColumns(['tipo']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TesourariaMovimento $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TesourariaMovimento $model)
    {
        $request = request()->all();
        $busca = $request['search']['value'] ?? null;
        return $model->newQuery()->with('membro')
            ->when(request('periodo'), function ($sql) {
                $datas = explode(' - ', request('periodo'));
                $periodo[0] = Carbon::createFromFormat('d/m/Y', $datas[0])->format('Y-m-d');
                $periodo[1] = Carbon::createFromFormat('d/m/Y', $datas[1])->format('Y-m-d');
                return $sql->whereBetween('data', $periodo);
            })
            ->when(!is_null($busca), function ($sql) use ($busca) {
                return $sql->where('descricao', 'like', '%' . $busca . '%');
            })
            ->when(request('tipo'), function ($sql) {
                return $sql->where('tipo', self::TIPO[request('tipo')]);
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('movimentos-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->parameters([
                "language" => [
                    "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fas fa-plus"></i> Novo Registro',
                        'className' => 'btn-novo-registro',
                        'extend' => "create"
                    ],
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('#'),
            Column::make('data')->title('Data'),
            Column::make('descricao')->title('Descrição'),
            Column::make('valor')->title('Valor'),
            Column::make('tipo')->title('Tipo'),
            Column::make('membro')->title('Membro'),
            Column::make('created_at')->title('Criado em'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TesourariaMovimentos_' . date('YmdHis');
    }

    public function totalizadores()
    {
        $fluxo = new TesourariaMovimento();
        $lancamentos = $this->query($fluxo)->get();
        $totalizadores['entradas'] = 0;
        $totalizadores['saidas'] = 0;
        foreach ($lancamentos as $lancamento) {
            if ($lancamento->tipo == TesourariaMovimento::SAIDA) {
                $totalizadores['saidas'] += intval($lancamento->valor);
                continue;
            }
            $totalizadores['entradas'] += intval($lancamento->valor);
        }
        $total = $totalizadores['entradas'] - $totalizadores['saidas'];
        $totalizadores['entradas'] = number_format($totalizadores['entradas'], 2, '.', ',');
        $totalizadores['saidas'] = number_format($totalizadores['saidas'], 2, '.', ',');
        $totalizadores['total'] = number_format($total, 0, '.', ',');

        return $totalizadores;

    }
}
