<?php

namespace App\Http\Livewire\Property;

use App\Models\Onboarding;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class OnboardingTable extends PowerGridComponent
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
    * @return Builder<\App\Models\Onboarding>
    */
    public function datasource(): Builder
    {
        return Onboarding::query();
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
            ->addColumn('property_id')
            ->addColumn('property_code', function (Onboarding $model) {
                $link = route('property.edit', $model->property_id);
                return "<a href='{$link}' class='text-blue-600 hover:underline' >{$model->property->code}</a>";
            })
            ->addColumn('property_data')
            ->addColumn('property_data_formatted', fn (Onboarding $model) => $model->property_data ? 'Completed' : 'Pending')
            ->addColumn('owner_data')
            ->addColumn('owner_data_formatted', fn (Onboarding $model) => $model->owner_data ? 'Completed' : 'Pending')
            ->addColumn('amenities_data')
            ->addColumn('amenities_data_formatted', fn (Onboarding $model) => $model->amenities_data ? 'Completed' : 'Pending')
            ->addColumn('rooms_data')
            ->addColumn('rooms_data_formatted', fn (Onboarding $model) => $model->rooms_data ? 'Completed' : 'Pending')
            ->addColumn('furnitures_data')
            ->addColumn('furnitures_data_formatted', fn (Onboarding $model) => $model->furnitures_data ? 'Completed' : 'Pending')
            ->addColumn('audit_id')
            ->addColumn('audit_formatted', fn (Onboarding $model) => $model->auditCompleted() ? 'Completed' : 'Pending')
            ->addColumn('completed')
            ->addColumn('completed_formatted', fn (Onboarding $model) => $model->completed ? 'Completed' : 'Pending')
            ->addColumn('created_at_formatted', fn (Onboarding $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Onboarding $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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

            Column::make('PROPERTY CODE', 'property_code')
                ->sortable(),

            // Column::make('PROPERTY DATA', 'property_data_formatted')
            //     ->sortable()
            //     ->makeBooleanFilter(),

            // Column::make('OWNER DATA', 'owner_data_formatted')
            //     ->sortable()
            //     ->makeBooleanFilter(),

            // Column::make('AMENITIES DATA', 'amenities_data_formatted')
            //     ->sortable()
            //     ->makeBooleanFilter(),

            // Column::make('ROOMS DATA', 'rooms_data_formatted')
            //     ->sortable()
            //     ->makeBooleanFilter(),

            // Column::make('FURNITURES DATA', 'furnitures_data_formatted')
            //     ->sortable()
            //     ->makeBooleanFilter(),

            // Column::make('AUDIT', 'audit_formatted')
            //     ->sortable(),

            Column::make('COMPLETED', 'completed_formatted')
                ->sortable()
                ->makeBooleanFilter(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Onboarding Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('show', 'View')
            ->class('bg-indigo-500 cursor-pointer text-white px-3 py-1 m-1 rounded text-sm')
            ->target('')
            ->route('onboarding.edit', ['onboarding' => 'id']),
            
            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('onboarding.destroy', ['onboarding' => 'id'])
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
     * PowerGrid Onboarding Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($onboarding) => $onboarding->id === 1)
                ->hide(),
        ];
    }
    */
}
