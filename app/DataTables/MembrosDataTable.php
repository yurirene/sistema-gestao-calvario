<?php

namespace App\DataTables;

use App\Models\Membro;
use App\Models\Membros;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MembrosDataTable extends DataTable
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
            ->addColumn('action', function($sql) {
                return view('membros.action', [
                    'route' => 'membros',
                    'id' => $sql->id,
                ]);
            })
            ->editColumn('nascimento', function($sql) {
                return Carbon::createFromFormat('d/m/Y', $sql->nascimento)->diffInYears();
            })
            ->editColumn('ano_membresia', function($sql) {
                return $sql->ano_membresia;
            })
            ->editColumn('cargo_id', function($sql) {
                return $sql->cargo ? $sql->cargo->descricao : null;
            })
            ->editColumn('created_at', function($sql) {
                return $sql->created_at->format('d/m/Y H:i:s');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Membro $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Membro $model)
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
            ->setTableId('membros-table')
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
            Column::make('nome')->title('Nome'),
            Column::make('nascimento')->title('Idade'),
            Column::make('sexo')->title('Sexo'),
            Column::make('telefone')->title('Telefone'),
            Column::make('ano_membresia')->title('Membro desde'),
            Column::make('cargo_id')->title('Cargo'),
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
        return 'Membros_' . date('YmdHis');
    }
}