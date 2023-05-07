<?php

namespace App\DataTables;

use App\Models\Membro;
use App\Models\Programacao;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FrequenciaDataTable extends DataTable
{
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
                return view('frequencia-dominical.action', [
                    'route' => 'frequencia-dominical',
                    'id' => $sql->id,
                ]);
            })
            ->addColumn('presentes', function ($sql) {
                return $sql->presentes->count();
            })
            ->editColumn('created_at', function ($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Programacao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Programacao $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('programacao-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->text('<i class="fas fa-plus"></i> Novo Registro'),
            );
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
                  ->addClass('text-center'),
            Column::make('data')->title('Data'),
            Column::make('nome')->title('Nome'),
            Column::make('presentes')->title('Presentes'),
            Column::make('visitantes')->title('Visitantes (Adultos)'),
            Column::make('visitantes_criancas')->title('Visitantes (Crianças)'),
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
        return 'Programacaos_' . date('YmdHis');
    }
}
