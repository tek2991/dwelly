<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AuditTable extends PowerGridComponent
{
    use ActionButton;

    public $property_id;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Audit>
     */
    public function datasource(): Builder
    {
        $query = Audit::query();

        if ($this->property_id) {
            $query->where('property_id', $this->property_id);
        }

        return $query->with('property', 'auditType', 'tenant.user', 'createdBy');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'property' => ['code'],
            'auditType' => ['name'],
            'tenant.user' => ['name'],
            'createdBy' => ['name'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('audit_type_id')
            ->addColumn('audit_type_name', function (Audit $audit) {
                return e($audit->auditType->name);
            })
            ->addColumn('property_id')
            ->addColumn('property_code', function (Audit $audit) {
                $link = route('property.show', $audit->property_id);
                return "<a href='{$link}' class='text-blue-700 hover:underline'>{$audit->property->code}</a>";
            })
            ->addColumn('created_by')
            ->addColumn('created_by_name', function (Audit $audit) {
                return e($audit->createdBy->name);
            })
            ->addColumn('updated_by')
            ->addColumn('tenant_id')
            ->addColumn('tenant_name', function (Audit $audit) {
                return e($audit->tenant ? $audit->tenant->user->name : 'NA');
            })
            ->addColumn('audit_date', function (Audit $audit) {
                return e(Carbon::parse($audit->audit_date)->format('d/m/Y'));
            })
            ->addColumn('completed')
            ->addColumn('completed_label', function (Audit $audit) {
                return e($audit->completed ? 'Yes' : 'No');
            })
            ->addColumn('created_at_formatted', fn (Audit $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Audit $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('AUDIT TYPE', 'audit_type_name', 'audit_type_id')
                ->sortable()
                ->searchable(),

            Column::make('PROPERTY', 'property_code', 'property_id')
                ->sortable()
                ->searchable(),

            Column::make('CREATED BY', 'created_by_name', 'created_by')
                ->searchable(),

            Column::make('TENANT (Pri)', 'tenant_name', 'tenant_id')
                ->searchable(),

            Column::make('COMPLETED', 'completed_label', 'completed')
                ->makeBooleanFilter('completed', 'Completed', 'Not Completed'),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Audit Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('bg-indigo-500 cursor-pointer text-white px-2 py-1.5 m-1 rounded text-sm')
                ->route('audit.show', ['audit' => 'id'])
                ->target(''),

            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('audit.destroy', ['audit' => 'id'])
               ->method('delete')
               */
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Audit Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($audit) => $audit->id === 1)
                ->hide(),
        ];
    }
    */
}
