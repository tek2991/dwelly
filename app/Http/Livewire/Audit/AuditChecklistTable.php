<?php

namespace App\Http\Livewire\Audit;

use App\Models\AuditChecklist;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AuditChecklistTable extends PowerGridComponent
{
    use ActionButton;

    public $audit;

    public $primary_audit_checklist_id;

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
     * @return Builder<\App\Models\AuditChecklist>
     */
    public function datasource(): Builder
    {
        $query = AuditChecklist::query();

        if($this->audit) {
            $query->where('audit_id', $this->audit->id);
        }

        if ($this->primary_audit_checklist_id) {
            $query->where('primary_audit_checklist_id', $this->primary_audit_checklist_id);
        }

        return $query->with('audit', 'checklistable', 'primaryAuditChecklist', 'secondaryAuditChecklists');
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
        return [];
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
            ->addColumn('checklistable_id')
            ->addColumn('checklistable_type')
            ->addColumn('checklistable_type_formatted', function (AuditChecklist $model) {
                // Letters after the last backslash
                $type = substr(strrchr($model->checklistable_type, '\\'), 1);
                return e($type);
            })

            ->addColumn('checklistable_type_name', fn (AuditChecklist $model) => e($model->checklistable->name))

            /** Example of custom column using a closure **/
            ->addColumn('checklistable_type_lower', function (AuditChecklist $model) {
                return strtolower(e($model->checklistable_type));
            })

            ->addColumn('is_primary')
            ->addColumn('primary', fn (AuditChecklist $model) => $model->is_primary ? '<span class="font-bold text-green-800">Self</span>' : '<span class="font-bold text-red-800">' . $model->primaryAuditChecklist->checklistable->name . '</span>')
            ->addColumn('is_primary_formatted', fn (AuditChecklist $model) => $model->is_primary ? 'Yes' : 'No')
            ->addColumn('remarks', function (AuditChecklist $model) {
                // Truncate remarks to 20 characters
                return e(substr($model->remarks, 0, 20));
            })
            ->addColumn('primary_audit_checklist_id')
            ->addColumn('secondary_audit_checklists', fn (AuditChecklist $model) => $model->secondaryAuditChecklists->count())
            ->addColumn('created_at_formatted', fn (AuditChecklist $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (AuditChecklist $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('TYPE', 'checklistable_type_formatted', 'checklistable_type')
                ->sortable(),

            Column::make('NAME', 'checklistable_type_name', 'checklistable_type'),

            Column::make('PRIMARY', 'primary')
                ->sortable(),

            Column::make('SECONDARY ITEMS', 'secondary_audit_checklists'),

            Column::make('REMARKS', 'remarks'),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
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
     * PowerGrid AuditChecklist Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-2.5 py-1 m-1 rounded text-sm')
                ->route('auditChecklist.show', ['auditChecklist' => 'id'])
                ->target(''),

            /*
           Button::make('destroy', 'Delete')
           ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
           ->route('audit-checklist.destroy', ['audit-checklist' => 'id'])
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
     * PowerGrid AuditChecklist Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($audit-checklist) => $audit-checklist->id === 1)
                ->hide(),
        ];
    }
    */
}
