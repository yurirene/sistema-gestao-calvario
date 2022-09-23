<?php

namespace App\DataTables;

use App\Models\Turma;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TurmasDataTable extends DataTable
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
                return view('turmas.actions.action', [
                    'route' => 'turmas',
                    'id' => $sql->id,
                ]);
            })
            ->editColumn('nome', function($sql) {
                return $sql->nome;
            })
            ->addColumn('alunos', function($sql) {
                return $sql->alunos->count();
            })
            ->editColumn('professor_id', function($sql) {
                return $sql->professor->nome;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Membro $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Turma $model)
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
            ->setTableId('turma-table')
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
            Column::make('professor_id')->title('Professor'),
            Column::make('alunos')->title('Nº Alunos'),
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
