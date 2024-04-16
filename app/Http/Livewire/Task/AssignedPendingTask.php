<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AssignedPendingTask extends PowerGridComponent
{
    use ActionButton;

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
     * @return Builder<\App\Models\Task>
     */
    public function datasource(): Builder
    {
        $this_user = auth()->user();
        return Task::query()
            ->where('assigned_to', $this_user->id)
            ->whereNot('task_state_id', 4)
            ->join('task_states', 'tasks.task_state_id', '=', 'task_states.id')
            ->join('priorities', 'tasks.priority_id', '=', 'priorities.id')
            ->join('users as assigned_to', 'tasks.assigned_to', '=', 'assigned_to.id')
            ->join('users as created_by', 'tasks.created_by', '=', 'created_by.id')
            ->select(
                'tasks.*',
                'task_states.name as task_state_name',
                'priorities.name as priority_name',
                'assigned_to.name as assigned_to_name',
                'created_by.name as created_by_name',
            );
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
            ->addColumn('id')
            ->addColumn('description')

            /** Example of custom column using a closure **/
            ->addColumn('description_lower', function (Task $model) {
                return strtolower(e($model->description));
            })

            ->addColumn('task_state_id')
            ->addColumn('task_state_name')
            ->addColumn('priority_id')
            ->addColumn('priority_name')
            ->addColumn('assigned_to')
            ->addColumn('assigned_to_name')
            ->addColumn('created_by')
            ->addColumn('created_by_name')
            ->addColumn('taskable_id')
            ->addColumn('taskable_type')
            ->addColumn('taskable_type_name', fn (Task $model) => $model->taskable_type === 'App\Models\Audit' ? 'Audit' : 'Onboarding')
            ->addColumn('created_at_formatted', fn (Task $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Task $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            // Column::make('ID', 'id')
            //     ->makeInputRange(),

            Column::make('DESCRIPTION', 'description')
                ->sortable()
                ->searchable()
                ->bodyAttribute('text-justify', 'white-space: normal !important;'),

            // Column::make('TASK STATE ID', 'task_state_id')
            //     ->makeInputRange(),

            Column::make('TASK STATE', 'task_state_name')
                ->sortable()
                ->searchable(),

            // Column::make('PRIORITY ID', 'priority_id')
            //     ->makeInputRange(),

            Column::make('PRIORITY', 'priority_name')
                ->sortable()
                ->searchable(),

            // Column::make('ASSIGNED TO', 'assigned_to')
            //     ->makeInputRange(),

            Column::make('ASSIGNED TO', 'assigned_to_name')
                ->sortable()
                ->searchable(),

            // Column::make('CREATED BY', 'created_by')
            //     ->makeInputRange(),

            // Column::make('CREATED BY', 'created_by_name')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('TASKABLE ID', 'taskable_id')
            //     ->makeInputRange(),

            // Column::make('TASKABLE TYPE', 'taskable_type')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            Column::make('TASK TYPE', 'taskable_type_name')
                ->sortable()
                ->searchable(),

            // Column::make('CREATED AT', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable(),
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
     * PowerGrid Task Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-1 m-1 rounded text-sm')
                ->route('task.show', ['task' => 'id'])
                ->target(''),
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
     * PowerGrid Task Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($task) => $task->id === 1)
                ->hide(),
        ];
    }
    */
}
