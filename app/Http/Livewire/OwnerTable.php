<?php

namespace App\Http\Livewire;

use App\Models\Owner;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class OwnerTable extends PowerGridComponent
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
     * @return Builder<\App\Models\Owner>
     */
    public function datasource(): Builder
    {
        return Owner::query()
            ->join('users', 'users.id', '=', 'owners.user_id')
            ->join('properties', 'properties.id', '=', 'owners.property_id')
            ->select('owners.*', 'users.name', 'users.email', 'users.phone_1', 'users.phone_2', 'properties.code as property_code')
            ->with('user', 'property');
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
            'user' => ['name', 'email', 'phone_1', 'phone_2'],
            'property' => ['code'],
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
            ->addColumn('user_id')
            ->addColumn('property_id')
            ->addColumn('onboarded_at_formatted', fn (Owner $model) => Carbon::parse($model->onboarded_at)->format('d/m/Y'))
            ->addColumn('outboarded_at_formatted', fn (Owner $model) => $model->outboarded_at ? Carbon::parse($model->outboarded_at)->format('d/m/Y') : 'N/A')
            ->addColumn('created_at_formatted', fn (Owner $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Owner $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('phone_1')
            ->addColumn('phone_2')
            ->addColumn('property_code')
            ->addColumn('property_code_link', function (Owner $model) {
                $link = route('property.show', $model->property_id);
                return "<a href='{$link}' class='text-blue-700 hover:underline'>{$model->property_code}</a>";
            });
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
            Column::make('USER ', 'name')
                ->searchable(),

            Column::make('PROPERTY', 'property_code_link', 'property_code')
                ->searchable()
                ->sortable(),

            Column::make('EMAIL', 'email')
                ->searchable()
                ->sortable(),

            Column::make('PHONE', 'phone_1')
                ->searchable()
                ->sortable(),

            Column::make('PHONE 2', 'phone_2')
                ->searchable()
                ->sortable(),

            Column::make('ONBOARDED AT', 'onboarded_at_formatted', 'onboarded_at')
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('OUTBOARDED AT', 'outboarded_at_formatted', 'outboarded_at')
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
     * PowerGrid Owner Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('owner.show', ['owner' => 'id']),

            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('owner.destroy', ['owner' => 'id'])
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
     * PowerGrid Owner Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($owner) => $owner->id === 1)
                ->hide(),
        ];
    }
    */
}
