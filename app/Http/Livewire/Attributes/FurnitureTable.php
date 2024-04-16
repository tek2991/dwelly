<?php

namespace App\Http\Livewire\Attributes;

use App\Models\Furniture;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class FurnitureTable extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'is_primary';
    public string $sortDirection = 'desc';

    public string $primary_furniture_id;

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
     * @return Builder<\App\Models\Furniture>
     */
    public function datasource(): Builder
    {
        $query = Furniture::query();

        if ($this->primary_furniture_id) {
            // dd($this->primary_furniture_id);
            $query->where('primary_furniture_id', $this->primary_furniture_id);
        }

        return $query;
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
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (Furniture $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('icon_path')
            ->addColumn('has_icon', fn (Furniture $model) => $model->icon_path ? 'Yes' : 'No')
            ->addColumn('show')
            ->addColumn('show_formatted', fn (Furniture $model) => $model->show ? 'Yes' : 'No')
            ->addColumn('primary', fn (Furniture $model) => $model->is_primary ? '<span class="font-bold text-green-800">Self</span>' : '<span class="font-bold text-red-800">' . $model->primaryFurniture->name . '</span>')
            ->addColumn('no_of_secondary', fn (Furniture $model) => $model->is_primary ? $model->secondaryFurnitures->count() : 'N/A')
            ->addColumn('created_at_formatted', fn (Furniture $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Furniture $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('NAME', 'name')
                ->sortable()
                ->searchable(),

            Column::make('ICON', 'has_icon')
                ->sortable(),

            Column::make('SHOW', 'show_formatted', 'show')
                ->sortable(),

            Column::make('PRIMARY', 'primary')
                ->sortable(),

            Column::make('SECONDARY FURNITURES', 'no_of_secondary')
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
     * PowerGrid Furniture Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('furniture.edit', ['furniture' => 'id'])
                ->target(''),

            /*
           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('furniture.destroy', ['furniture' => 'id'])
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
     * PowerGrid Furniture Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($furniture) => $furniture->id === 1)
                ->hide(),
        ];
    }
    */  
}
